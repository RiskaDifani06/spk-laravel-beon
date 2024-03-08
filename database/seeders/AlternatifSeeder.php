<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Alternatif::create([
      'nama' => 'Alternatif 1'
    ]);
  }
}
