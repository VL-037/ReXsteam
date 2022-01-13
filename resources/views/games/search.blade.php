@extends('layouts.layout')
@section('content')

    <div class="container-fluid mt-2">
        <h1 class="text-center mb-3"><b>Search Games</b></h1>
        @if (count($games) == 0)
            <p class="text-center">No games content can be showed.</p>
        @else
            <ul class="row">
                @for ($i = 0; $i < count($games); $i++)
                    <li class="list-unstyled mb-3 col">
                        <div class="card" style="width: 20rem;">
                            <a href="/games/{{ $games[$i]->id }}">
                                <img src="{{ $games[$i]->cover }}" alt="" style="width: 100%;">
                            </a>
                            <div class="card-body">
                                <p class="card-title"><b>{{ $games[$i]->name }}</b></p>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text"><small>{{ $games[$i]->category->name }}</small></p>
                                    <p><small>Rp. {{ $games[$i]->price }}</small></p>
                                </div>
                            </div>
                        </div>
                    </li>
                @endfor
            </ul>
        @endif

    </div>

@endsection
