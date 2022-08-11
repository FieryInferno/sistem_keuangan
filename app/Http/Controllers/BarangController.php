<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
  public function index()
  {
    return view('barang', [
      'title' => 'Barang',
      'active' => 'barang',
      'data' => Barang::all(),
    ]);
  }

  public function create()
  {
    return view('form_barang', [
      'title' => 'Barang',
      'active' => 'barang',
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'harga' => 'required',
    ]);

    Barang::create($request->all());

    return redirect('barang')->with('success', 'Berhasil tambah barang.');
  }

  public function edit(Barang $barang)
  {
    return view('form_barang', [
      'title' => 'Barang',
      'active' => 'barang',
      'barang' => $barang,
    ]);
  }

  public function update(Request $request, Barang $barang)
  {
    $request->validate([
      'nama' => 'required',
      'harga' => 'required',
    ]);
    
    $barang->update($request->all());

    return redirect('barang')->with('success', 'Berhasil edit barang.');
  }

  public function destroy(Barang $barang)
  {
    $barang->delete();
    return redirect('barang')->with('success', 'Berhasil hapus barang.');
  }
}
