@extends('layouts.navbar2')

@section('content')
    <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 me-3">Edit Data Sub Kriteria</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subkriterias.update', $subkriteria->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <input type="hidden" name="kriteria_id_old" value="{{ $subkriteria->kriteria_id }}" > --}}
        <div class="row g-3 mb-2 align-items-center">
            <div class="col-2">
                <label for="inputNama" class="col-form-label">Nama</label>
            </div>
            <div class="col-auto">
                <input type="text" name="nama" value="{{ $subkriteria->nama }}" id="inputNama" class="form-control"
                    aria-describedby="NamaHelpInline">
            </div>
        </div>
        <div class="row g-3 mb-2 align-items-center">
            <div class="col-2">
                <label for="inputKriteriaId" class="col-form-label">Kategori Kriteria</label>
            </div>
            <div class="col-auto">
                <select name="kriteria_id" class="form-select">
                    {{-- <option>- Pilih -</option> --}}
                    @foreach ($kriterias as $kriteria)
                        @if ($kriteria->id == $subkriteria->kriteria_id)
                            <option value="{{ $kriteria->id }}" selected>{{ $kriteria->nama }}</option>
                        @else
                            <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-3 mb-2 align-items-center">
            <div class="col-2">
                <label for="inputPrioritas" class="col-form-label">Prioritas</label>
            </div>
            <div class="col-auto">
                <input type="number" min="1" max="20" name="prioritas" value="{{ $subkriteria->prioritas }}" id="inputPrioritas" class="form-control"
                    aria-describedby="PrioritasHelpInline">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection

@push('css')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endpush
