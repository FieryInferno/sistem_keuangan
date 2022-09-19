<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\LabaRugiExport;
use PDF;

class LabaRugiController extends Controller
{
  public function index()
  {
    $pemasukan = Pemasukan::all();
    $pengeluaran = Pengeluaran::all();
    $merged = $pemasukan->merge($pengeluaran);

    return view('laba_rugi.index', [
      'title'       => 'Laba Rugi',
      'active'      => 'laba_rugi',
      'pemasukan'   => $pemasukan,
      'pengeluaran' => $pengeluaran,
      'from'        => $merged->min('tanggal'),
      'to'          => $merged->max('tanggal'),
    ]);
  }

  // public function excel(Request $request)
  // {
  //   if ($request->query('tanggal') || $request->query('bulan') || $request->query('tahun')) {
  //     if ($request->query('tanggal')) {
  //       $date = $request->query('tahun') . '-' . $request->query('bulan') . '-' . $request->query('tanggal');

  //       $pemasukan = Pemasukan::whereDate('tanggal', $date)->get();
  //       $pengeluaran = Pengeluaran::whereDate('tanggal', $date)->get();
  //     } else if ($request->query('bulan')) {
  //       $pemasukan = Pemasukan::whereMonth('tanggal', $request->query('bulan'))->whereYear('tanggal', $request->query('tahun'))->get();
  //       $pengeluaran = Pengeluaran::whereMonth('tanggal', $request->query('bulan'))->whereYear('tanggal', $request->query('tahun'))->get();
  //     } else {
  //       $pemasukan = Pemasukan::whereYear('tanggal', $request->query('tahun'))->get();
  //       $pengeluaran = Pengeluaran::whereYear('tanggal', $request->query('tahun'))->get();
  //     }
  //   } else {
  //     $pemasukan = Pemasukan::all();
  //     $pengeluaran = Pengeluaran::all();
  //   }

  //   $data = $pemasukan->concat($pengeluaran)->sortBy('tanggal');

  //   return Excel::download(new LabaRugiExport($data), 'jurnal.xlsx');
  // }

  public function pdf()
  {
    $pemasukan = Pemasukan::all();
    $pengeluaran = Pengeluaran::all();
    $merged = $pemasukan->merge($pengeluaran);

    $pdf = PDF::setOption('isHtml5ParserEnabled', true)->setOption('isRemoteEnabled', true)->loadview('laba_rugi.pdf', [
      'pemasukan'   => $pemasukan,
      'pengeluaran' => $pengeluaran,
      'from'        => $merged->min('tanggal'),
      'to'          => $merged->max('tanggal'),
    ]);
    
    return $pdf->stream('laba_rugi.pdf');
  }
}
