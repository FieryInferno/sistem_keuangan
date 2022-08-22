<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePelayanan extends Model
{
  use HasFactory;
  protected $fillable = ['tipe', 'harga', 'jasa_id'];

  public function tipe()
  {
    return $this->belongsTo(Jasa::class, 'id', 'jasa_id');
  }
}
