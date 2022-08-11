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
      'user' => $barang,
    ]);
  }

  public function update(Request $request, Barang $barang)
  {
    $request->validate([
      'nama' => 'required',
      'username' => 'required',
    ]);

    $barang->nama = $request->nama;
    $barang->username = $request->username;

    if ($request->password) {
      $barang->password = Hash::make($request->password);
    }

    $barang->role = 'barang';

    $barang->save();

    return redirect('barang')->with('success', 'Berhasil tambah barang.');
  }

  public function destroy($id)
  {
    $barang = Barang::find($id);

    // dd($barang);

    $barang->delete();
    
    return redirect('barang')->with('success', 'Berhasil hapus barang.');
  }
}
