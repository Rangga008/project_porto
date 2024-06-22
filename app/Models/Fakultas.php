<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
  use HasFactory;

  protected $table = 'fakultas';

  public $timestamps = false;

  protected $fillable = ['nama'];

  public function Prodi()
  {
    return $this->hasMany(Prodi::class, 'id_fakultas');
  }
}
