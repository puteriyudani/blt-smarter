@extends('layouts.navbar2')

@section('content')
    <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 me-3">Penilaian</h1>
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

    @if ($message = Session::get('msg'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('penilaianform.store') }}" method="POST">
        @csrf
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
                            @foreach ($kriterias as $kriteria => $value)
                                <td>
                                    <select name="subkriteria_id[{{ $valt->id }}][]" class="form-control">
                                        @foreach ($value->subkriterias as $k_1 => $v_1)
                                            <option value="{{ $v_1->id }}"
                                                {{ $v_1->id == $valt->penilaianform[$kriteria]->subkriteria_id ? 'selected' : '' }}>
                                                {{ $v_1->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                        @else
                            @foreach ($kriterias as $kriteria => $value)
                                <td>
                                    <select name="subkriteria_id[{{ $valt->id }}][]" class="form-control">
                                        @foreach ($value->subkriterias as $k_1 => $v_1)
                                            <option value="{{ $v_1->id }}">
                                                {{ $v_1->nama }}</option>
                                        @endforeach
                                    </select>
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
