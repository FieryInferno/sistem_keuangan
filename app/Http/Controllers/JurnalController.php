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

  public function excel(Request $request)
  {
    if ($request->query('tanggal') || $request->query('bulan') || $request->query('tahun')) {
      if ($request->query('tanggal')) {
        $date = $request->query('tahun') . '-' . $request->query('bulan') . '-' . $request->query('tanggal');

        $pemasukan = Pemasukan::whereDate('tanggal', $date)->get();
        $pengeluaran = Pengeluaran::whereDate('tanggal', $date)->get();
      } else if ($request->query('bulan')) {
        $pemasukan = Pemasukan::whereMonth('tanggal', $request->query('bulan'))->whereYear('tanggal', $request->query('tahun'))->get();
        $pengeluaran = Pengeluaran::whereMonth('tanggal', $request->query('bulan'))->whereYear('tanggal', $request->query('tahun'))->get();
      } else {
        $pemasukan = Pemasukan::whereYear('tanggal', $request->query('tahun'))->get();
        $pengeluaran = Pengeluaran::whereYear('tanggal', $request->query('tahun'))->get();
      }
    } else {
      $pemasukan = Pemasukan::all();
      $pengeluaran = Pengeluaran::all();
    }

    $data = $pemasukan->concat($pengeluaran)->sortBy('tanggal');

    return Excel::download(new JurnalExport($data), 'jurnal.xlsx');
  }
}
