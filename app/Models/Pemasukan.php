<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
  use HasFactory;

  public function jasa()
  {
    return $this->hasOne(Jasa::class, 'id', 'jasa_id');
  }

  public function barang()
  {
    return $this->hasOne(Barang::class, 'id', 'barang_id');
  }

  public function tipe()
  {
    return $this->hasOne(TipePelayanan::class, 'id', 'tipe_id');
  }
}
