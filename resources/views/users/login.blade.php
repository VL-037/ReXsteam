@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <form action="/login" method="POST">
            @csrf
            @if (session()->has('error'))
                <div class="position-absolute">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username">
            </div>

            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="text" name="password" id="password">
            </div>

            <div class="mb-3">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Rember Me</label><br>
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>

@endsection
