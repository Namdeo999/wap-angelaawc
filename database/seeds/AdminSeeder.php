<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\MyApp;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'role' => MyApp::ADMINISTRATOR,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin@123'),
        ]);
    }
}
