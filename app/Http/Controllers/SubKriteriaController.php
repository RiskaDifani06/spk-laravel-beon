<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $kriteria = Kriteria::all();
    $subKriteria = SubKriteria::query()->paginate(10);

    $title = 'Delete Sub Kriteria!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'sub-kriteria.destroy');

    return view('sub-kriteria.index', compact('subKriteria', 'kriteria'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    
    $kriteria = Kriteria::all();

    return view('sub-kriteria.create', compact('kriteria'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
{
    $request->validate([
        'kriteria_id' => 'required',
        'nama' => 'required',
        'bobot' => 'required',
        'tipe' => 'required',
    ]);

    try {
        SubKriteria::create($request->all());
        return redirect()->route('sub-kriteria.index');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
}


  /**
   * Display the specified resource.
   */
  public function show(SubKriteria $subKriteria)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(SubKriteria $subKriteria)
  {
    $kriteria = Kriteria::all();

    return view('sub-kriteria.edit', compact('subKriteria', 'kriteria'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, SubKriteria $subKriteria)
  {
    $request->validate([
      'kriteria_id' => 'required',
      'nama' => 'required',
      'bobot' => 'required',
      'tipe' => 'required',
    ]);

    try {
      $subKriteria->update($request->all());
      return redirect()->route('sub-kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SubKriteria $subKriteria)
  {
    try {
      $subKriteria->delete();
      return redirect()->route('sub-kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}
