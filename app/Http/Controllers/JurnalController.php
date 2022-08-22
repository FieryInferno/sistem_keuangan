<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JurnalExport;

class JurnalController extends Controller
{
  public function index()
  {
    $pemasukan = Pemasukan::all();
    $pengeluaran = Pengeluaran::all();
    $data = $pemasukan->concat($pengeluaran)->sortBy('tanggal');

    return view('jurnal', [
      'title' => 'Jurnal',
      'active' => 'jurnal',
      'data' => $data,
    ]);
  }

  public function excel()
  {
    $pemasukan = Pemasukan::all();
    $pengeluaran = Pengeluaran::all();
    $data = $pemasukan->concat($pengeluaran)->sortBy('tanggal');

    return Excel::download(new JurnalExport($data), 'jurnal.xlsx');
  }
}
