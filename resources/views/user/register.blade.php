@extends('app')
@section('content')
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-md-6 col-lg-4">
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <p class="alert alert-danger">{{ $err }}</p>
                        @endforeach
                    @endif
                    <form class="card" action="{{ route('register.action') }}" method="POST">
                        @csrf
                        <h5 class="card-title fw-400">Sign Up</h5>

                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Name" name="name"
                                    value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Username" name="username"
                                    value="{{ old('username') }}">
                            </div>

                            <div class="form-group">
                                <select class="form-select" name="level" id="level" aria-label="Floating label select example">
                                    <option selected>Level</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Petugas</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>

                            <div class="form-group">
                                <input class="form-control" type="password" placeholder="Confirm Password"
                                    name="password_confirm">
                            </div>


                            <button class="btn btn-block btn-bold btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endpush
