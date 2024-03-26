<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Delete the specified record if it exists
       User::where('email', 'yubrajkoirala7278@gmail.com')->delete();
       // add super admin 
       User::create([
        'name'=>'Super_Admin',
        'email'=>'yubrajkoirala7278@gmail.com',
        'password'=>Hash::make('123456'),
        'is_admin'=>1
       ]);
    }
}
