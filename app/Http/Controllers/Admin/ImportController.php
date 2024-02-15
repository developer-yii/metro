<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        if($request->ajax()) {

            $rules = [
                'file_type' =>  'required',
                'file'      =>  'required'
            ];

            $messages = [
                'file_type' => 'File Type is required.',
                'file'      => 'File is required.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()) {
                $result = ['status' => false, 'errors' => $validator->errors()];
            } else {

                if ($request->hasFile('file')) {

                    $file = $request->file('file');
                    $extension = strtolower($file->getClientOriginalExtension());

                    if($request->file_type == "csv") {

                        if($extension != "csv") {
                            $result = ['status' => false, 'message' => 'Errors in file', 'file_upload_errors' => "Please Select CSV file"];
                            return $result;
                        }

                        $reader = new Csv();
                        $spreadsheet = $reader->load($file->getPathname());
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();

                        $message = 'CSV file imported successfully';
                    } else {

                        if($extension != "xlsx") {
                            $result = ['status' => false, 'message' => 'Errors in file', 'file_upload_errors' => "Please Select Excel file"];
                            return $result;
                        }

                        $spreadsheet = IOFactory::load($file);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();

                        $message = 'Excel file imported successfully';
                    }

                    $chunkSize = 500; // Define how many records you want in each chunk
                    $chunks = array_chunk(array_slice($sheetData, 1), $chunkSize); // Slice to remove header row

                    $errors = []; // Initialize an array to hold error messages

                    foreach($chunks as $chunkIndex => $chunk) {
                        $users = [];

                        foreach($chunk as $rowIndex => $data) {

                            // Validate each row
                            $line = ($chunkIndex * $chunkSize) + $rowIndex + 2; // Calculate line number (+2 for header and zero-index offset)

                            // Check for null or empty values in required fields
                            if(empty($data[0]) || empty($data[1]) || empty($data[2])) {
                                $errors[] = "Row $line: Required fields are missing.";
                                continue; // Skip this row
                            }

                            // Validate email
                            if(!filter_var($data[1], FILTER_VALIDATE_EMAIL)) {
                                $errors[] = "Row $line: Invalid email format.";
                                continue; // Skip this row
                            }

                            if(User::where('email', $data[1])->exists()) {
                                $errors[] = "Row $line: email alredy exists.";
                                continue; // Skip this row
                            }

                            $active = strtolower($data[3]) == "active" ? 1 : 0;
                            $users[] = [
                                'name'      => $data[0],
                                'email'     => $data[1],
                                'password'  => Hash::make($data[2]),
                                'is_active' => $active
                                // Add other fields as necessary
                            ];
                        }

                        if (!empty($errors)) {
                            $result = ['status' => false, 'message' => 'Errors in file', 'file_errors' => $errors];
                            return $result;
                        }

                        if(!empty($users)) {
                            DB::table('users')->insert($users); // Bulk insert
                        }
                    }

                    $result = ['status' => true, 'message' => $message, 'data' => []];
                }

            }
        } else {
            $result = ['status' => false, 'message' => 'Invalid request', 'data' => []];
        }

        return $result;
    }
}
