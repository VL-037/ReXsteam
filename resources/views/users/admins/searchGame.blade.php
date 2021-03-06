@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <div class="px-5">
            <h1><b>Manage Games</b></h1>
            <p><b>Filter by Games Name</b></p>
            <form action="/admin/games/filter" method="GET" class="mb-3">
                <div class="w-50">
                    <input class="form-control mr-sm-2" type="text" name="name" placeholder="Search" aria-label="Search">
                </div>
                @foreach ($categories as $category)
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                            id="{{ $category->name }}" name="categories[]">
                        <label class="form-check-label" for="{{ $category->name }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
                <button class="btn btn-primary">Search</button>
            </form>
        </div>

        <ul class="row">
            @if (count($games) > 0)
                @foreach ($games as $game)
                    <li class="list-unstyled mb-3 col">
                        <div class="card" style="width: 20rem;">
                            <a href="/games/{{ $game->id }}">
                                <img src="{{ $game->cover }}" alt="" style="width: 100%;">
                            </a>
                            <div class="card-body">
                                <p class="card-title"><b>{{ $game->name }}</b></p>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text"><small>{{ $game->category->name }}</small></p>
                                </div>
                                <form action="/admin/games/{{ $game->id }}/update" class="d-inline mb-2">
                                    <button class="btn btn-info">Update</button>
                                </form>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#{{ $game->id }}">
                                    Delete
                                </button>
                                <div class="modal fade" id="{{ $game->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="{{ $game->name }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{ $game->id }}">Delete Cart Item</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <b>{{ $game->name }}</b>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <form action="/admin/games/{{ $game->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <p>There are no Games content can be showed</p>
            @endif
        </ul>
        <div class="d-flex flex-row-reverse">
            {{ $games->withQueryString()->links() }}
        </div>
    </div>

    <div class="position-fixed" style="z-index: 10000; right: 1%; bottom: 7%;">
        <a href="/admin/games/new">
            <button class="btn btn-success position-relative">Create Game</button>
        </a>
    </div>

@endsection
