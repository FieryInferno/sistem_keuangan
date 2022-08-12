<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Jasa;

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
      'nama' => 'required',
      'jasa_id' => 'required',
      'tip' => 'required',
    ]);
    Pemasukan::create($request->all());
    return redirect('pemasukan')->with('success', 'Berhasil tambah pemasukan.');
  }

  public function edit(Pemasukan $pemasukan)
  {
    return view('pemasukan.form', [
      'title' => 'Pemasukan',
      'active' => 'pemasukan',
      'pemasukan' => $pemasukan,
      'jasa' => Jasa::all(),
    ]);
  }

  public function update(Request $request, Pemasukan $pemasukan)
  {
    $request->validate([
      'nama' => 'required',
      'jasa_id' => 'required',
      'tip' => 'required',
    ]);
    $pemasukan->update($request->all());
    return redirect('pemasukan')->with('success', 'Berhasil edit pemasukan.');
  }

  public function destroy(Pemasukan $pemasukan)
  {
    $pemasukan->delete();
    return redirect('pemasukan')->with('success', 'Berhasil hapus pemasukan.');
  }
}
