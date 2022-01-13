@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <form action="/games/{{$game->id}}/checkAge" method="POST">

            @csrf

            <div class="mx-auto text-center">
                <img src="{{$game->cover}}" alt="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="date">Date</label>
                <input class="form-control" type="date" name="date" id="date">
            </div>

            <button class="btn btn-success">View Page</button>
            <a href="/">
            <button type="button" class="btn">Cancel</button>
            </a>

        </form>
    </div>

@endsection