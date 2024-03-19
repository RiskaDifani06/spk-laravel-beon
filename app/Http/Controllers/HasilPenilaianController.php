<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternativeValues;
use App\Models\HasilPenilaian;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class HasilPenilaianController extends Controller
{
  public function index()
  {
    $hasilPenilaian = $this->ranking();
    $alternatif = Alternatif::all()->pluck('nama', 'id');

    return view('ranking', compact('hasilPenilaian', 'alternatif'));
  }

  public function menghitung_utility()
  {
    $totalAlternatif = Alternatif::count();
    $totalSubKriteria = SubKriteria::count();

    $minValues = [];
    $maxValues = [];

    $utilityValues = collect();  // Use a collection for object-like structure

    for ($i = 1; $i <= $totalAlternatif; $i++) {
      $minValues[$i] = AlternativeValues::where('alternatif_id', $i)->min('value');
      $maxValues[$i] = AlternativeValues::where('alternatif_id', $i)->max('value');

      $utilityValuesForAlternatif = [];
      for ($j = 1; $j <= $totalSubKriteria; $j++) {
        // Assuming nilaiAlternatif is an ordered collection matching sub-criteria
        $nilaiAlternatif = AlternativeValues::where('alternatif_id', $i)->pluck('value');
        $utilityValuesForAlternatif[$j] = ($nilaiAlternatif[$j - 1] - $minValues[$i]) / ($maxValues[$i] - $minValues[$i]);
      }

      $utilityValues->put($i, $utilityValuesForAlternatif);  // Add alternatif_id as key
    }

    return $utilityValues;
  }

  public function nilai_akhir()
  {
    $utilityValues = $this->menghitung_utility();
    $totalAlternatif = Alternatif::count();
    $totalSubKriteria = SubKriteria::count();
    $bobotSubKriteria = SubKriteria::all()->pluck('bobot');
    $normalisasiBobot = [];

    for ($i = 1; $i <= $totalSubKriteria; $i++) {
      $normalisasiBobot[$i] = $bobotSubKriteria[$i - 1] / $bobotSubKriteria->sum();
    }

    $nilaiAkhir = [];

    for ($i = 1; $i <= $totalAlternatif; $i++) {
      for ($j = 1; $j <= $totalSubKriteria; $j++) {
        $nilaiAkhir[$i][$j] = $utilityValues[$i][$j] * ($normalisasiBobot[$j]);
      }
    }

    return $nilaiAkhir;
  }

  public function ranking()
  {
    $nilaiAkhir = $this->nilai_akhir();
    $totalAlternatif = Alternatif::count();
    $totalSubKriteria = SubKriteria::count();

    $hasilAkhir = [];
    for ($i = 1; $i <= $totalAlternatif; $i++) {
      for ($j = 1; $j <= $totalSubKriteria; $j++) {
        $hasilAkhir[$i] = array_sum($nilaiAkhir[$i]);
      }
    }
    arsort($hasilAkhir, SORT_NUMERIC);  // Sort by hasil_penilaian (descending)

    HasilPenilaian::truncate();
    foreach ($hasilAkhir as $alternatif_id => $hasil_penilaian) {
      HasilPenilaian::create([
        'alternatif_id' => $alternatif_id,
        'hasil_penilaian' => $hasil_penilaian
      ]);
    }

    return $hasilAkhir;
  }
}