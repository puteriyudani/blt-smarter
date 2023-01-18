@extends('layouts.navbar')

@section('content')
    <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 me-3">Perhitungan</h1>
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
@endsection

@push('css')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endpush
