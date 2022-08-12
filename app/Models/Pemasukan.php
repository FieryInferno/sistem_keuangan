<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
  use HasFactory;
  protected $fillable = ['nama', 'jasa_id', 'tip'];

  public function jasa()
  {
    return $this->hasOne(Jasa::class, 'id', 'jasa_id');
  }
}
