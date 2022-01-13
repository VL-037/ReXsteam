@extends('layouts.layout')
@section('content')

    <div class="container-fluid mt-2">
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
        <h1 class="text-center mb-3"><b>Top Games</b></h1>
        @if (count($games) == 0)
            <p class="text-center"><b>No Game can be Displayed</b></p>
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
            <div class="container d-flex flex-row-reverse">
                {{ $games->withQueryString()->links() }}
            </div>
        @endif
        
    </div>

@endsection
