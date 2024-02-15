<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public $breadcrumbs;
    public $pageTitle;

    public function index()
    {
        $pageTitle = "Change Password";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Change Password', 'url' => '']
        ];

        return view('admin.changepassword.index', compact('pageTitle','breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        successMsg('update', 'Password changed successfully!');
        return redirect()->route('change-password.index');
    }
}
