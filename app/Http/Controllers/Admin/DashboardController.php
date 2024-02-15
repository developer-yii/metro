<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $breadcrumbs;
    protected $pageTitle;

    public function index(Request $request)
    {
        $pageTitle = "Dashboard";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
        ];

        return view('dashboard', compact('breadcrumbs','pageTitle'));
    }

    public function basicElements()
    {
        $pageTitle = "Dashboard";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Basic Form Elements', 'url' => ''],
        ];

        return view('admin.form-elements.basic', compact('breadcrumbs','pageTitle'));
    }

    public function advanceElements()
    {
        $pageTitle = "Dashboard";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Advanced Form Elements', 'url' => ''],
        ];

        return view('admin.form-elements.advance', compact('breadcrumbs','pageTitle'));
    }
}
