@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Penilaian') }}</h1>

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

      <!-- Penilaian table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="m-0 h4 font-weight-bold text-primary">Data Penilaian</h2>
          <a href="{{ route('sub-kriteria.create') }}" class="btn btn-primary">Tambah Penilaian</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="subKriteriaTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  {{-- <th>Nama Penilai</th> --}}
                  <th>Nama Alternatif</th>
                  <th>Nama Sub Kriteria</th>
                  <th>Nilai Alternatif</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($semuaNilaiAlternatif as $nilaiAlternatif)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{-- <td>{{ $nilaiAlternatif->penilai->nama }}</td> --}}
                    <td>{{ $nilaiAlternatif->alternatif->nama }}</td>
                    <td>{{ $nilaiAlternatif->subKriteria->nama }}</td>
                    <td>{{ $nilaiAlternatif->value }}</td>
                    <td>
                      <a href="{{ route('penilaian.edit', $nilaiAlternatif->id) }}" class="btn btn-warning">
                        Edit
                      </a>
                      <a href="{{ route('penilaian.destroy', $nilaiAlternatif->id) }}" class="btn btn-danger"
                        data-confirm-delete="true">Delete</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
              <span>
                Showing
                {{ $semuaNilaiAlternatif->firstItem() }}
                to
                {{ $semuaNilaiAlternatif->lastItem() }}
                of
                {{ $semuaNilaiAlternatif->total() }}
                entries
              </span>
              <ul class="pagination">
                {{ $semuaNilaiAlternatif->links() }}
              </ul>
            </nav>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection