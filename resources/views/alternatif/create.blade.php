@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Alternatif') }}</h1>

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

      <!-- Alternatif table -->
      <div class="card shadow mb-4">
        <div class="card-header">
          <h2 class="m-0 h4 font-weight-bold text-primary">Tambah Alternatif</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('alternatif.store') }}" method="POST">
            @csrf
            <div class="form-group
              @error('nama') is-invalid @enderror">
              <label for="nama">Nama Alternatif</label>
              <input type="text" class="form-control" id="nama" name="nama"
                value="{{ old('nama') }}" placeholder="Masukkan Nama Alternatif">
              @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror

              <button type="submit" class="btn btn-primary mt-3">Simpan</button>
              <a href="{{ route('alternatif.index') }}" class="btn btn-secondary mt-3">Batal</a>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
