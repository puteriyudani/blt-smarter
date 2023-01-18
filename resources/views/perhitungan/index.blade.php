@extends('layouts.navbar')

@section('content')
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 me-3">Normalisasi</h1>
            </div>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Nama Masyarakat</th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($masyarakats as $masyarakat => $valt)
                        <tr>
                            <td>{{ $valt->nama }}</td>
                            @if (count($valt->penilaian) > 0)
                                @foreach ($valt->penilaian as $key => $value)
                                    <td>
                                        {{ $value->subkriteria->bobot }}
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td>Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 me-3">Nilai Utility</h1>
            </div>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Masyarakat / Kriteria</th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($utility as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            @foreach ($value as $key1 => $value1)
                                <td>
                                    {{ $value1 }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 me-3">Perangkingan</h1>
            </div>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th></th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->nama }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Bobot</th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->bobot }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endpush
