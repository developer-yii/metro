<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function createUser($data)
    {
        unset($data['password_confirmation']);
        return User::create($data);
    }

    public function updateUser($userId, $data)
    {
        $user = User::find($userId);

        if(!empty($data['password'])) {
            unset($data['password_confirmation']);
        } else {
            unset($data['password_confirmation']);
            unset($data['password']);
        }

        if(isset($data['profile_pic'])) {
            unset($data['profile_pic']);
        }

        $user->update($data);
        return $user;
    }

    public function getUserById($userId)
    {
        return User::find($userId);
    }

    public function getAllUsers()
    {
        return User::select("users.*");
    }

    public function uploadProfilePicture($file)
    {
        $dir = "profile_pics/";
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . "_" . time() . "." . $extension;
        Storage::disk('local')->put($dir . $filename, $file->get());

        return $filename;
    }

    public function deleteProfilePicture($userId)
    {
        try {
            $user = User::findOrFail($userId);

            if ($user->image) {
                $dir = "profile_pics/";

                if(Storage::disk('local')->exists($dir .$user->image)) {
                    Storage::delete($dir . $user->image);
                }
            }

            return true; // Deletion successful
        } catch (Exception $e) {
            // User not found
            return false;
        }
    }
}
