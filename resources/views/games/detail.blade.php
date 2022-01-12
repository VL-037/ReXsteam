@extends('layouts.layout')
@section('content')

    <div class="container mt-2">
        @if (session()->has('success'))
            <div class="position-absolute">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @elseif (session()->has('error'))
            <div class="position-absolute">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="d-flex mb-3">
            <source class="flex-grow-1" src="{{ $game->trailer }}" type="video/webm">
            <img class="rounded flex-grow-1"
                src="{{ $game->cover }}" style="width: 100%; height: 20rem;"
                alt="{{ $game->cover }}_cover">
            <div class="px-2">
                <img class="rounded"
                    src="{{ $game->cover }}"
                    alt="{{ $game->cover }}_cover" style="width: 100%">
                <h4><b>{{ $game->name }}</b></h4>
                <p>{{ $game->description_short }}</p>
                <p><b>Genre</b>: {{ $game->category->name }}</p>
                <p><b>Release Date</b>: {{ $game->created_at }}</p>
                <p><b>Developer</b>: {{ $game->developer }}</p>
                <p><b>Publisher</b>: {{ $game->publisher }}</p>
            </div>
        </div>

        @if (!$isOwned)
            @if (!Auth::user() || Auth::user()->role == 'Member')
                <div class="border border-secondary p-3 rounded mb-3">
                    <p class="mb-3"><b>Buy {{ $game->name }}</b></p>
                    <form action="/games/{{ $game->id }}" method="POST">
                        @csrf
                        <p><b>Rp. {{$game->price}}</b></p>
                        <button class="btn btn-success">Add To Cart</button>
                    </form>
                </div>
            @endif
        @endif

        <div class="mb-3">
            <h4>About This Game</h4>
            <hr class="border border-secondary">
            <p>{{ $game->description_long }}</p>
        </div>
    </div>

@endsection
