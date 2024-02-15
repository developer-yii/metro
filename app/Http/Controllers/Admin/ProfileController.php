<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userService;
    public $breadcrumbs;
    public $pageTitle;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $pageTitle = "My Account";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'My Account', 'url' => '']
        ];

        return view('admin.profile.index', compact('pageTitle','breadcrumbs'));
    }

    public function editProfile()
    {
        $pageTitle = "Edit Profile";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'My Account', 'url' => route('profile.index')],
            ['title' => 'Edit Profile', 'url' => '']
        ];

        $user = $this->userService->getUserById(auth()->user()->id);
        return view('admin.profile.edit', compact('pageTitle','breadcrumbs','user'));
    }

    public function storeProfile(ProfileRequest $request)
    {
        $userData = $request->all();

        if ($request->hasFile('profile_pic') && !empty($request->profile_pic)) {
            $userData['image'] = $this->userService->uploadProfilePicture($request->file('profile_pic'));

            if(!empty($userData['image'])) {
                $this->userService->deleteProfilePicture(auth()->user()->id);
            }
        }

        $user = $this->userService->updateUser(auth()->user()->id, $userData);

        successMsg("update", "Profile Updated Successfully.");
        return redirect()->route('profile.index');
    }
}
