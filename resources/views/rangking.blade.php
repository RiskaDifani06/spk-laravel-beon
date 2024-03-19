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
          <h2 class="m-0 h4 font-weight-bold text-primary">Hasil Ranking Metode Smart</h2>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="subKriteriaTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Ranking</th>
                  <th>Nama Alternatif</th>
                  <th>Skor</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($hasilPenilaian as $alternatifId => $score)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $alternatif->get($alternatifId) }}</td>
                    <td>{{ $score }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection