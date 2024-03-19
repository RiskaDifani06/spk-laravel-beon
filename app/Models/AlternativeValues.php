<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternativeValues extends Model
{
  use HasFactory;

  protected $fillable = [
    'alternatif_id',
    'subkriteria_id',
    'value',
  ];

  public function alternatif()
  {
    return $this->belongsTo(Alternatif::class);
  }

  public function subkriteria()
  {
    return $this->belongsTo(Subkriteria::class);
  }
}