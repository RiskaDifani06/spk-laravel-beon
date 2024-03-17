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

      <!-- Sub Kriteria table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="m-0 h4 font-weight-bold text-primary">Data Sub Kriteria</h2>
          <a href="{{ route('sub-kriteria.create') }}" class="btn btn-primary">Tambah Sub Kriteria</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="subKriteriaTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kriteria</th>
                  <th>Nama Sub Kriteria</th>
                  <th>Bobot</th>
                  <th>Tipe</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subKriteria as $key => $sub)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $sub->kriteria->nama }}</td>
                    <td>{{ $sub->nama }}</td>
                    <td>{{ $sub->bobot }}</td>
                    <td class="text-uppercase">{{ $sub->tipe }}</td>
                    <td>
                      <a href="{{ route('sub-kriteria.edit', $sub->id) }}" class="btn btn-warning">
                        Edit
                      </a>
                      <a href="{{ route('sub-kriteria.destroy', $sub->id) }}" class="btn btn-danger"
                        data-confirm-delete="true">Delete</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
              <span>
                Showing
                {{ $subKriteria->firstItem() }}
                to
                {{ $subKriteria->lastItem() }}
                of
                {{ $subKriteria->total() }}
                entries
              </span>
              <ul class="pagination">
                {{ $subKriteria->links() }}
              </ul>
            </nav>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
