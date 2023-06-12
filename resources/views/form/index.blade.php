@extends('layouts.navbar2')

@section('content')
    <!-- svg -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="edit" viewBox="0 0 16 16">
            <path
                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd"
                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
        </symbol>
        <symbol id="delete" viewBox="0 0 16 16">
            <path
                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
        </symbol>
        <symbol id="add" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
        </symbol>
    </svg>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 me-3">Data</h1>
        <a href="{{ route('forms.create') }}" class="me-3">
            <svg class="bi pe-none mt-2" width="30" height="22" style="fill: green;">
                <use xlink:href="#add" />
            </svg>
        </a>
        <a href="{{ route('penilaianform.index') }}" class="btn btn-primary me-2">Penilaian</a>
        <a href="{{ route('perhitunganform.index') }}" class="btn btn-primary me-2">Perhitungan</a>
        <a href="{{ route('rangkingform.index') }}" class="btn btn-primary">Rangking</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($forms as $form)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $form->nama }}</td>
                        <td>
                            <form action="{{ route('forms.destroy', $form->id) }}" method="POST">
                                <a href="{{ route('forms.edit', $form->id) }}" style="text-decoration: none;">
                                    <svg class="bi pe-none" width="20" height="16" style="fill: green;">
                                        <use xlink:href="#edit" />
                                    </svg>
                                </a>

                                @csrf
                                @method('DELETE')

                                <button class="btn mb-1" type="submit">
                                    <svg class="bi pe-none" width="20" height="16" style="fill: red;">
                                        <use xlink:href="#delete" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Tidak ada data</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('css')
    <style>
        .bi {
            vertical-align: -.125em;
        }

        .btn {
            background-color: Transparent;
            background-repeat: no-repeat;
            border: none;
            cursor: pointer;
            overflow: hidden;
        }
    </style>
@endpush
