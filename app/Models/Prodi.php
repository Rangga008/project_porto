<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
  use HasFactory;

  protected $table = 'prodi';

  public $timestamps = false;

  protected $fillable = ['id_fakultas', 'nama'];

  public function getFakultas()
  {
    return $this->belongsTo(Fakultas::class, 'id_fakultas');
  }
}
