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
  public function index(Request $request)
  {
    if ($request->query('tanggal_awal')) {
      $pemasukan = Pemasukan::whereBetween('tanggal', [$request->query('tanggal_awal'), $request->query('tanggal_akhir')])->get();
      $pengeluaran = Pengeluaran::whereBetween('tanggal', [$request->query('tanggal_awal'), $request->query('tanggal_akhir')])->get();
    } else {
      $pemasukan = Pemasukan::all();
      $pengeluaran = Pengeluaran::all();
    }

    $merged     = $pemasukan->merge($pengeluaran);
    $dataArray  = [
      'pemasukan'   => $pemasukan,
      'pengeluaran' => $pengeluaran,
      'from'        => $request->query('tanggal_awal') ? $request->query('tanggal_awal') : $merged->min('tanggal'),
      'to'          => $request->query('tanggal_akhir') ? $request->query('tanggal_akhir') : $merged->max('tanggal'),
    ];

    if ($request->query('pdf')) {
      $pdf  = PDF::setOption('isHtml5ParserEnabled', true)->setOption('isRemoteEnabled', true)->loadview('laba_rugi.pdf', $dataArray);
      
      return $pdf->stream('laba_rugi.pdf');
    } else {
      $dataArray['title']   = 'Laba Rugi';
      $dataArray['active']  = 'laba_rugi';

      return view('laba_rugi.index', $dataArray);
    }
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
