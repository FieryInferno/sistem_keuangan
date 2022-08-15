<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class JurnalController extends Controller
{
  public function index()
  {
    $pemasukan = Pemasukan::all();
    $pengeluaran = Pengeluaran::all();
    $data = $pemasukan->merge($pengeluaran)->sortBy('tanggal');
    
    return view('jurnal', [
      'title' => 'Jurnal',
      'active' => 'jurnal',
      'data' => $data,
    ]);
  }
}
