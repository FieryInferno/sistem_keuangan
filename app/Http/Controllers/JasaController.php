<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jasa;

class JasaController extends Controller
{
  public function index()
  {
    return view('jasa.index', [
      'title' => 'Jasa',
      'active' => 'jasa',
      'data' => Jasa::all(),
    ]);
  }

  public function create()
  {
    return view('jasa.form', [
      'title' => 'Jasa',
      'active' => 'jasa',
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'tipe' => 'required',
      'harga' => 'required',
    ]);
    Jasa::create($request->all());
    return redirect('jasa')->with('success', 'Berhasil tambah jasa.');
  }

  public function edit(Jasa $jasa)
  {
    return view('jasa.form', [
      'title' => 'Jasa',
      'active' => 'jasa',
      'jasa' => $jasa,
    ]);
  }

  public function update(Request $request, Jasa $jasa)
  {
    $request->validate([
      'nama' => 'required',
      'tipe' => 'required',
      'harga' => 'required',
    ]);
    $jasa->update($request->all());
    return redirect('jasa')->with('success', 'Berhasil edit jasa.');
  }

  public function destroy(Jasa $jasa)
  {
    $jasa->delete();
    return redirect('jasa')->with('success', 'Berhasil hapus jasa.');
  }
}
