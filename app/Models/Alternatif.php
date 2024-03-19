<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
  use HasFactory;

  protected $table = 'alternatif';
  protected $fillable = ['nama'];

  public function values()
  {
    return $this->hasMany(AlternativeValues::class, 'alternatif_id');
  }

  public function hasilPenilaian()
  {
    return $this->hasOne(HasilPenilaian::class, 'alternatif_id');
  }
}
