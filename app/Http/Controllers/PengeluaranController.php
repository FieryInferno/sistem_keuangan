<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
  public function index()
  {
    return view('pengeluaran.index', [
      'title' => 'Pengeluaran',
      'active' => 'pengeluaran',
      'data' => Pengeluaran::all(),
    ]);
  }

  public function create()
  {
    return view('pengeluaran.form', [
      'title' => 'Pengeluaran',
      'active' => 'pengeluaran',
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'no_pengeluaran' => 'required',
      'tanggal' => 'required',
      'nama_kas_keluar' => 'required',
      'harga' => 'required',
      'qty' => 'required',
      'keterangan' => 'required',
    ]);
    Pengeluaran::create($request->all());
    return redirect('pengeluaran')->with('success', 'Berhasil tambah pengeluaran.');
  }

  public function edit(Pengeluaran $pengeluaran)
  {
    return view('pengeluaran.form', [
      'title' => 'Pengeluaran',
      'active' => 'pengeluaran',
      'pengeluaran' => $pengeluaran,
    ]);
  }

  public function update(Request $request, Pengeluaran $pengeluaran)
  {
    $request->validate([
      'no_pengeluaran' => 'required',
      'tanggal' => 'required',
      'nama_kas_keluar' => 'required',
      'harga' => 'required',
      'qty' => 'required',
      'keterangan' => 'required',
    ]);
    $pengeluaran->update($request->all());
    return redirect('pengeluaran')->with('success', 'Berhasil edit pengeluaran.');
  }

  public function destroy(Pengeluaran $pengeluaran)
  {
    $pengeluaran->delete();
    return redirect('pengeluaran')->with('success', 'Berhasil hapus pengeluaran.');
  }
}
