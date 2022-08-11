<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->insert([
      [
        'nama' => 'admin',
        'username' => 'admin',
        'password' => Hash::make('admin'),
        'role' => 'admin',
      ], [
        'nama' => 'karyawan',
        'username' => 'karyawan',
        'password' => Hash::make('karyawan'),
        'role' => 'karyawan',
      ],
    ]);
  }
}
