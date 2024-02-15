<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    public function exportExcel()
    {
        // Your data retrieval logic here
        $users = User::select('name', 'email', 'is_active')->get();

        // Create a new PhpSpreadsheet instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Status');

        // Populate data
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->name);
            $sheet->setCellValue('B' . $row, $user->email);

            if($user->is_active == 1) {
                $sheet->setCellValue('C' . $row, "Active");
            } else {
                $sheet->setCellValue('C' . $row, "Deactive");
            }
            $row++;
        }

        // Write file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'users.xlsx';
        $writer->save($fileName);

        // Download the file
        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    public function exportCsv()
    {
        $users = User::select('name', 'email', 'is_active')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Status');

        // Populate data
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->name);
            $sheet->setCellValue('B' . $row, $user->email);

            if($user->is_active == 1) {
                $sheet->setCellValue('C' . $row, "Active");
            } else {
                $sheet->setCellValue('C' . $row, "Deactive");
            }

            $row++;
        }

        // Write CSV file
        $writer = new Csv($spreadsheet);
        $fileName = 'users.csv';
        $writer->save($fileName);

        // Download file
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
