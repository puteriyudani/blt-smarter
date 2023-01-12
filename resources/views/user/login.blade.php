@extends('app')
@section('content')
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-md-6 col-lg-4">
                    @if (session('success'))
                        <p class="alert alert-success">{{ session('success') }}</p>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            <p class="alert alert-danger">{{ $err }}</p>
                        @endforeach
                    @endif
                    <form class="card" action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <h5 class="card-title fw-400">Sign In</h5>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" id="username" type="text" placeholder="Username"
                                    name="username">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" type="password" placeholder="Password"
                                    name="password">
                            </div>

                            <button class="btn btn-block btn-bold btn-primary">Sign In</button>
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
