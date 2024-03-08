@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Sub Kriteria') }}</h1>

  @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-12">

      <!-- Kriteria form -->
      <div class="card shadow mb-4">
        <div class="card-header">
          <h2 class="m-0 h4 font-weight-bold text-primary">Tambah Sub Kriteria</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('sub-kriteria.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="kriteria_id">Nama Kriteria</label>
              <select name="kriteria_id" id="kriteria_id" class="form-control">
                <option value="">Pilih Kriteria</option>
                @foreach ($kriteria as $k)
                  <option value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
              </select>
              @error('kriteria_id')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nama">Nama Sub Kriteria</label>
              <input type="text" name="nama" id="nama" class="form-control"
                value="{{ old('nama') }}">
              @error('nama')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            {{-- <div class="form-group">
              <label for="bobot">Bobot</label>
              <input type="number" name="bobot" id="bobot" class="form-control"
                value="{{ old('bobot') }}">
              @error('bobot')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div> --}}
            <div class="form-group">
              <label for="bobot">Bobot</label>
              <input type="number" name="bobot" id="bobot" class="form-control" step="0.01" value="{{ old('bobot') }}">
              @error('bobot')
                  <div class="text-danger mt-2">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('sub-kriteria.index') }}" class="btn btn-secondary mt-3">Batal</a>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
