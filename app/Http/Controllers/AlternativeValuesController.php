<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternativeValues;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlternativeValuesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $semuaAlternatif = Alternatif::all();
    $semuaSubKriteria = SubKriteria::all();
    $semuaNilaiAlternatif = AlternativeValues::query()->paginate(10);
    $title = 'Delete Nilai Alternatif!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'penilaian.destroy');
    return view('penilaian.index', compact('semuaAlternatif', 'semuaSubKriteria', 'semuaNilaiAlternatif'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $semuaAlternatif = Alternatif::all();
    $semuaSubKriteria = SubKriteria::all();
    return view('penilaian.create', compact('semuaAlternatif', 'semuaSubKriteria'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'alternatif_id' => 'required|exists:alternatif,id',
      'subkriteria_id' => 'required|exists:sub_kriteria,id',
      'value' => 'required|numeric',
    ]);

    try {
      AlternativeValues::create($request->all());
      Alert::success('Berhasil', 'Data berhasil disimpan');
      return redirect()->route('penilaian.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(AlternativeValues $alternativeValues)
  {
    $semuaAlternatif = Alternatif::all();
    $semuaSubKriteria = SubKriteria::all();
    return view('penilaian.show', compact('alternativeValues', 'semuaAlternatif', 'semuaSubKriteria'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(AlternativeValues $alternativeValues)
  {
    $semuaAlternatif = Alternatif::all();
    $semuaSubKriteria = SubKriteria::all();
    return view('penilaian.edit', compact('alternativeValues', 'semuaAlternatif', 'semuaSubKriteria'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, AlternativeValues $alternativeValues)
  {
    $request->validate([
      'alternatif_id' => 'required|exists:alternatif,id',
      'subkriteria_id' => 'required|exists:sub_kriteria,id',
      'value' => 'required|numeric',
    ]);

    try {
      $alternativeValues->update($request->all());
      Alert::success('Berhasil', 'Data berhasil diubah');
      return redirect()->route('penilaian.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(AlternativeValues $alternativeValues)
  {
    try {
      $alternativeValues->delete();
      Alert::success('Berhasil', 'Data berhasil dihapus');
      return redirect()->route('penilaian.index');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}