<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
  use HasFactory;
  protected $fillable = ['no_pengeluaran', 'tanggal', 'nama_kas_keluar', 'harga', 'qty', 'keterangan'];
}
