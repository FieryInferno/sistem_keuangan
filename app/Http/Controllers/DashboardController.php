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
    $bulan = 1;

    for ($i=0; $i < 12; $i++) {
      $pemasukan = Pemasukan::whereMonth('tanggal', $bulan)->get();
      $totalPemasukan = 0;

      foreach ($pemasukan as $key) {
        switch ($key->jenis_pemasukan) {
          case 'barang':
            $harga = $key->barang->harga;
            break;
          case 'jasa':
            $harga = $key->is_express === 'true' ? $key->tipe->harga + 10000 : $key->tipe->harga;
            break;
          
          default:
            # code...
            break;
        }
        $totalPemasukan += $harga * $key->qty;
      }

      $data['pemasukan'][$i] = $totalPemasukan;
      $data['pengeluaran'][$i] = Pengeluaran::whereMonth('tanggal', $bulan)->sum(DB::raw('qty * harga'));
      $bulan++;
    }

    $pemasukan = Pemasukan::all();
    $pengeluaran = Pengeluaran::all();
    $dataJurnal = $pemasukan->concat($pengeluaran)->sortBy('tanggal');
    $debit = 0;
    $kredit = 0;

    foreach ($dataJurnal as $key) {
      if ($key->jenis_pemasukan) {
        $harga = 0;

        switch ($key->jenis_pemasukan) {
          case 'barang':
            $harga = $key->barang->harga;
            break;
          case 'jasa':
            $harga = $key->is_express === 'true' ? $key->tipe->harga + 10000 : $key->tipe->harga;
            break;
          
          default:
            # code...
            break;
        }

        $totalHarga = $harga * $key->qty;

        if ($key->diskon) {
          $debit += $totalHarga - ($totalHarga * $key->diskon / 100);
        } else {
          $debit += $totalHarga;
        }
      } else {
        $kredit += $key->harga * $key->qty;
      }
    }

    return view('dashboard', [
      'title' => 'Dashboard',
      'active' => 'dashboard',
      'karyawan' => User::where('role', '=', 'karyawan')->count(),
      'barang' => Barang::count(),
      'jasa' => Jasa::count(),
      'data' => $data,
      'keutungan' => $debit - $kredit,
    ]);
  }
}
