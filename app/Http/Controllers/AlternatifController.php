<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlternatifController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $alternatif = Alternatif::query()->paginate(10);
    $title = 'Delete Alternatif!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'alternatif.destroy');
    return view('alternatif.index', compact('alternatif'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('alternatif.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'nama' => 'required'
    ]);

    try {
      Alternatif::create($request->all());
      Alert::success('Berhasil', 'Data berhasil disimpan');
      return redirect()->route('alternatif.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Alternatif $alternatif)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Alternatif $alternatif)
  {
    return view('alternatif.edit', compact('alternatif'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Alternatif $alternatif)
  {
    $request->validate([
      'nama' => 'required'
    ]);

    try {
      $alternatif->update($request->all());
      Alert::success('Berhasil', 'Data berhasil diubah');
      return redirect()->route('alternatif.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Alternatif $alternatif)
  {
    try {
      $alternatif->delete();
      alert()->success('Berhasil', 'Data berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
      $errorCode = $e->getCode();
      if ($errorCode === '4400' || $errorCode === '23000') {  // Common foreign key constraint error codes
        alert()->error('Gagal Hapus', 'Data alternatif masih digunakan. Hapus data yang terkait terlebih dahulu.');
      } else {
        alert()->error('Gagal Hapus', 'Terjadi kesalahan saat menghapus data.');
        throw $e;
      }
    }

    return back();
  }
}
