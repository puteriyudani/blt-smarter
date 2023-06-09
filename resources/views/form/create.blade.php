@extends('layouts.navbar2')

@section('content')
    <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 me-3">Tambah Data</h1>
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

    @if (!isset($jumlahMasyarakat))
        <form action="{{ route('form-masyarakats.store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-2 align-items-center">
                <div class="col-3">
                    <label for="jumlah_masyarakat" class="col-form-label">Masukkan Jumlah Masyarakat</label>
                </div>
                <div class="col-auto">
                    <input type="number" name="jumlah_masyarakat" id="jumlah_masyarakat" class="form-control"
                        aria-describedby="jumlah_masyarakatHelpInline" placeholder="minimal 2">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    @else
        <form action="{{ route('forms.store') }}" method="POST">
            @for ($i = 1; $i <= $jumlahMasyarakat; $i++)
                @csrf
                <div class="row g-3 mb-2 align-items-center">
                    <div class="col-2">
                        <label for="inputNama" class="col-form-label">Nama {{ $i }}</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="nama[]" id="inputNama" class="form-control"
                            aria-describedby="NamaHelpInline">
                    </div>
                </div>
            @endfor

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    @endif
@endsection

@push('css')
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endpush
