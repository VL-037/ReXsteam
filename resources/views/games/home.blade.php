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
        @endif
        <h1 class="text-center mb-3"><b>Top Games</b></h1>
        <ul class="row">
            @for ($i = 0; $i < count($games); $i++)
                <li class="list-unstyled mb-3 col">
                    <div class="card" style="width: 20rem;">
                        <a href="/games/{{ $games[$i]->id }}">
                            <img src="https://mobitekno.com/wp-content/uploads/2017/12/20171108094330_Review_Cover_Fire__Game_Action_Untuk_Fans_Militer_Modern-768x432.jpg"
                                alt="" style="width: 100%;">
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
    </div>

@endsection
