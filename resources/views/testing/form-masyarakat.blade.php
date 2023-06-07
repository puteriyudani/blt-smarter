@extends('layouts.navbar2')

@section('content')
    <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 me-3">Form Data Masyarakat</h1>
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
        <form action="{{ route('form-masyarakat.store') }}" method="POST">
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
        <form action="{{ route('penilaian-form-masyarakat.store') }}" method="POST">
            @for ($i = 1; $i <= $jumlahMasyarakat; $i++)
                <h6>Data {{ $i }}</h6>
                @csrf
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
                        <tr>
                            <td><input type="text" name="nama[]" id="inputNama" class="form-control" aria-describedby="NamaHelpInline"></td>
                    
                            @foreach ($kriterias as $kriteria => $value)
                                <td>
                                    <select name="subkriteria_id[{{ $kriteria }}][]" class="form-control">
                                        @foreach ($value->subkriterias as $k_1 => $v_1)
                                            <option value="{{ $v_1->id }}">
                                                {{ $v_1->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                    
                        </tr>
                    </tbody>
                    
                </table>
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
