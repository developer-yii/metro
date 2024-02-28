<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobLog;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Carbon\Carbon;

class JobLogController extends Controller
{
    public function index(){
        $pageTitle = "Job Logs";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Job Logs', 'url' => route('jobLogs.index')]
        ];

        return  view('admin.jobLogs.index', compact('breadcrumbs', 'pageTitle'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $offers = JobLog::orderBy('created_at', 'desc')->get();

            return DataTables::of($offers)
                ->addIndexColumn()
                ->addColumn('create_time', function ($row) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d.m.Y H.i');
                })                
                ->make(true);
        }
    }
}
