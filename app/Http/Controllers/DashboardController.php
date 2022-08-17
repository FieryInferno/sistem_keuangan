<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Jasa;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard', [
      'title' => 'Dashboard',
      'active' => 'dashboard',
      'karyawan' => User::where('role', '=', 'karyawan')->count(),
      'barang' => Barang::count(),
      'jasa' => Jasa::count(),
    ]);
  }
}
