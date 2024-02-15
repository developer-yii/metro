<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::where('email','admin@gmail.com')->first() === null) {
            User::create([
                'id'       => 1,
                'name'     => "Super Admin",
                'email'    => 'admin@gmail.com',
                'password' => bcrypt('12345678')
            ]);
        }
    }
}
