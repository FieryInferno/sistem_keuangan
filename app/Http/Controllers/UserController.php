<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
    return view('karyawan.index', [
      'title' => 'Karyawan',
      'active' => 'karyawan',
      'data' => User::where('role', '=', 'karyawan')->get(),
    ]);
  }

  public function create()
  {
    return view('karyawan.form', [
      'title' => 'Karyawan',
      'active' => 'karyawan',
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
      'username' => 'required',
      'password' => 'required',
    ]);

    $user = new User;
    $user->nama = $request->nama;
    $user->username = $request->username;
    $user->password = Hash::make($request->password);
    $user->role = 'karyawan';

    $user->save();
    return redirect('karyawan')->with('success', 'Berhasil tambah karyawan.');
  }

  public function edit($id)
  {
    $user = User::find($id);

    return view('karyawan.index', [
      'title' => 'Karyawan',
      'active' => 'karyawan',
      'user' => $user,
    ]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'username' => 'required',
    ]);

    $user = User::find($id);
    $user->nama = $request->nama;
    $user->username = $request->username;

    if ($request->password) {
      $user->password = Hash::make($request->password);
    }

    $user->role = 'karyawan';

    $user->save();

    return redirect('karyawan')->with('success', 'Berhasil tambah karyawan.');
  }

  public function destroy($id)
  {
    $user = User::find($id);
    return redirect('karyawan')->with('success', 'Berhasil hapus karyawan.');
  }
}
