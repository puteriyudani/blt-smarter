@extends('layouts.navbar')

@section('content')
    <div class="card shadow mb-4 mt-3">
        <div class="card-body">
            <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 me-3">Persentase Penerima</h1>
            </div>

            <form action="{{ route('persen.store') }}" method="post">
                @csrf

                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-2">
                        <label for="persentage" class="col-form-label">Persentase :</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" name="persentage" id="persentage" class="form-control" aria-describedby="PersentageHelpInline" required>
                    </div>
                </div>

                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-2">
                        <label for="total_dana_desa" class="col-form-label">Jumlah Dana Desa :</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" name="total_dana_desa" id="total_dana_desa" class="form-control" aria-describedby="TotalDanaDesaHelpInline" required>
                    </div>
                </div>

                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-2">
                        <label for="dana_per_orang" class="col-form-label">Dana per Orang :</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" name="dana_per_orang" id="dana_per_orang" class="form-control" aria-describedby="DanaPerOrangHelpInline" required>
                    </div>
                </div>
            
                <button type="submit">Hitung</button>
            </form>

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
