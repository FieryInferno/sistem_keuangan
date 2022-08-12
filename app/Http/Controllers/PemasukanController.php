<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Jasa;
use App\Models\Barang;

class PemasukanController extends Controller
{
  public function index()
  {
    return view('pemasukan.index', [
      'title' => 'Pemasukan',
      'active' => 'pemasukan',
      'data' => Pemasukan::all(),
    ]);
  }

  public function create()
  {
    return view('pemasukan.form', [
      'title' => 'Pemasukan',
      'active' => 'pemasukan',
      'jasa' => Jasa::all(),
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'no_pemasukan' => 'required',
      'tanggal' => 'required',
      'jenis_pemasukan' => 'required',
      'barang_jasa_id' => 'required',
      'harga' => 'required',
      'qty' => 'required',
      'diskon' => 'required',
      'keterangan' => 'required',
    ]);

    $pemasukan = new Pemasukan;
    $pemasukan->no_pemasukan = $request->no_pemasukan;
    $pemasukan->tanggal = $request->tanggal;
    $pemasukan->jenis_pemasukan = $request->jenis_pemasukan;

    switch ($request->jenis_pemasukan) {
      case 'barang':
        $pemasukan->barang_id = $request->barang_jasa_id;
        $barang = Barang::find($request->barang_jasa_id);
        break;
      case 'jasa':
        $pemasukan->jasa_id = $request->barang_jasa_id;
        break;
      
      default:
        # code...
        break;
    }

    $pemasukan->harga = $request->harga;
    $pemasukan->qty = $request->qty;
    $pemasukan->diskon = $request->diskon;
    $pemasukan->keterangan = $request->keterangan;

    $pemasukan->save();
    if ($request->jenis_pemasukan === 'barang') {
      $barang->qty -= $request->qty;

      $barang->save();
    }

    return redirect('pemasukan')->with('success', 'Berhasil tambah pemasukan.');
  }

  public function edit(Pemasukan $pemasukan)
  {
    return view('pemasukan.form', [
      'title' => 'Pemasukan',
      'active' => 'pemasukan',
      'pemasukan' => $pemasukan,
      'barang_jasa' => $pemasukan->jenis_pemasukan === 'barang' ? Barang::all() : Jasa::all(),
    ]);
  }

  public function update(Request $request, Pemasukan $pemasukan)
  {
    $request->validate([
      'no_pemasukan' => 'required',
      'tanggal' => 'required',
      'jenis_pemasukan' => 'required',
      'barang_jasa_id' => 'required',
      'harga' => 'required',
      'qty' => 'required',
      'diskon' => 'required',
      'keterangan' => 'required',
    ]);

    $pemasukan->no_pemasukan = $request->no_pemasukan;
    $pemasukan->tanggal = $request->tanggal;
    $pemasukan->jenis_pemasukan = $request->jenis_pemasukan;

    switch ($request->jenis_pemasukan) {
      case 'barang':
        $pemasukan->barang_id = $request->barang_jasa_id;
        $barang = Barang::find($request->barang_jasa_id);
        break;
      case 'jasa':
        $pemasukan->jasa_id = $request->barang_jasa_id;
        break;
      
      default:
        # code...
        break;
    }

    $pemasukan->harga = $request->harga;

    if ($request->jenis_pemasukan === 'barang') {
      $barang->qty += $pemasukan->qty;
    }

    $pemasukan->qty = $request->qty;
    $pemasukan->diskon = $request->diskon;
    $pemasukan->keterangan = $request->keterangan;

    $pemasukan->save();

    if ($request->jenis_pemasukan === 'barang') {
      $barang->qty -= $request->qty;

      // dd($barang->qty);

      $barang->save();
    }

    return redirect('pemasukan')->with('success', 'Berhasil tambah pemasukan.');
  }

  public function destroy(Pemasukan $pemasukan)
  {
    $pemasukan->delete();
    return redirect('pemasukan')->with('success', 'Berhasil hapus pemasukan.');
  }

  public function getBarangJasa(Request $request)
  {
    switch ($request->query('tipe')) {
      case 'barang':
        $data = Barang::all();
        break;
      case 'jasa':
        $data = Jasa::all();
        break;
      
      default:
        # code...
        break;
    }

    return response()->json($data);
  }
}
