@extends('layouts.navbar2')

@section('content')
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 me-3">Normalisasi</h1>
            </div>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th scope="col">Nama</th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($forms as $form => $valt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $valt->nama }}</td>
                            @if (count($valt->penilaianform) > 0)
                                @foreach ($valt->penilaianform as $key => $value)
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
                        <th>No</th>
                        <th scope="col">Nama</th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($utility as $key => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $key }}</td>
                            @foreach ($value as $key1 => $value1)
                                <td>
                                    {{ $value1 }}
                                </td>
                            @endforeach
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
                <h1 class="h2 me-3">Nilai Akhir</h1>
            </div>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->nama }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Bobot</th>
                        @foreach ($kriterias as $kriteria => $value)
                            <th>{{ $value->bobot }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nilaiAkhirPerUtility as $key => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $key }}</td>
                            @foreach ($value as $key_1 => $value_1)
                                <td>{{ $value_1 }}</td>
                            @endforeach
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
    <a href="{{ route('rangkingform.index') }}"><button class="btn btn-primary mb-3" type="submit">Lihat Rangking</button></a>
@endsection

@push('css')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endpush
