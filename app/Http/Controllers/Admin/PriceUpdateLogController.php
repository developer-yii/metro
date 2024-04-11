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
            $offers = PriceUpdateLog::orderBy('created_at', 'desc')->get();

            return DataTables::of($offers)
                ->addIndexColumn()
                ->addColumn('create_time_formatted', function ($row) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d.m.Y H.i');
                })
                ->make(true);
        }
    }
}
