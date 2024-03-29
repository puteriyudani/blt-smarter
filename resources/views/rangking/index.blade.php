@extends('layouts.navbar')

@section('content')
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 me-3">Rangking</h1>
            </div>

            @if (isset($hasilPembagianPerOrang) && $hasilPembagianPerOrang !== null)
                <p>Jumlah Penerima: {{ $hasilPembagianPerOrang }}</p>
            @else
                <p>Tidak ada data.</p>
            @endif

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nilai Akhir</th>
                        <th scope="col">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp

                    @forelse ($nilaiAkhir as $key => $value)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $key }}</td>
                            @foreach ($value as $key_1 => $value_1)
                                <td>{{ $value_1 }} %</td>
                            @endforeach
                            <td>{{ $no++ }}</td>
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
@endsection

@push('css')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endpush
