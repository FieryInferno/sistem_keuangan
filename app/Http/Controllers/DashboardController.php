<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    $bulan = 7;

    for ($i=0; $i < 6; $i++) {
      $data['pemasukan'][$i] = Pemasukan::whereMonth('tanggal', $bulan)->sum(DB::raw('qty * harga'));
      $data['pengeluaran'][$i] = Pengeluaran::whereMonth('tanggal', $bulan)->sum(DB::raw('qty * harga'));
      $bulan++;
    }

    return view('dashboard', [
      'title' => 'Dashboard',
      'active' => 'dashboard',
      'karyawan' => User::where('role', '=', 'karyawan')->count(),
      'barang' => Barang::count(),
      'jasa' => Jasa::count(),
      'data' => $data,
    ]);
  }
}
