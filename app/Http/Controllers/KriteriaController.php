<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $kriteria = Kriteria::query()->paginate(10);
    $title = 'Delete Kriteria!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'kriteria.destroy');
    return view('kriteria.index', compact('kriteria'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('kriteria.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required',
    ]);

    try {
      Kriteria::create($request->all());
      Alert::success('Berhasil', 'Data berhasil disimpan');
      return redirect()->route('kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Kriteria $kriteria)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Kriteria $kriteria)
  {
    return view('kriteria.edit', compact('kriteria'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Kriteria $kriteria)
  {
    $request->validate([
      'nama' => 'required',
    ]);

    try {
      $kriteria->update($request->all());
      Alert::success('Berhasil', 'Data berhasil diubah');
      return redirect()->route('kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Kriteria $kriteria)
  {
    $kriteria->delete();
    alert()->success('Berhasil', 'Data berhasil dihapus');
    return back();
  }
}
