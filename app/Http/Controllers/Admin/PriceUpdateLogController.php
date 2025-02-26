<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PriceUpdateLog;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Carbon\Carbon;

class PriceUpdateLogController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = "Price Update Logs";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Logs', 'url' => route('priceUpdatelogs.index')]
        ];

        return  view('admin.priceUpdatelogs.index', compact('breadcrumbs', 'pageTitle'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $query = PriceUpdateLog::query()
                ->orderBy('created_at', 'desc'); // Move orderBy here

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('create_time_formatted', function ($row) {
                    return Carbon::parse($row->created_at)->format('d.m.Y H.i');
                })
                ->smart(true)
                ->make(true);
        }
    }
}
