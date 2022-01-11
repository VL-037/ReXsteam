@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <h2><b>Create Game</b></h2>
        <form action="/admin/games" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label" for="name">Game Name</label>
                <input class="form-control" type="text" name="name" id="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description_short">Game Description</label>
                <input class="form-control" type="text" name="description_short" id="description_short" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="description_long">Game Long Description</label>
                <textarea class="form-control" name="description_long" id="description_long" cols="30" rows="5"
                    placeholder="Write a few sentences about the game"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">Category</label>
                <select class="form-control" name="category" id="category">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="developer">Game Developer</label>
                <input class="form-control" type="text" name="developer" id="developer" required>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="publisher">Game Publisher</label>
                <input class="form-control" type="text" name="publisher" id="publisher" required>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="price">Game Price</label>
                <input class="form-control" type="number" name="price" id="price" min="1" max="1000000" required>
            </div>
            <div class=" mb-3">
                <label class="form-label" for="cover">Game Cover</label>
                <input class="form-control" type="file" name="cover" id="cover">
            </div>

            <div class="   mb-3">
                <label class="form-label" for="trailer">Game Trailer</label>
                <input class="form-control" type="file" name="trailer" id="trailer">
            </div>

            <div class="  mb-3">
                <input type="checkbox" name="isAdult" id="isAdult">
                <label class="form-label" for="isAdult">Only Adults?</label>
            </div>

            <div class="row">
                <div class="col  mb-3">
                    <a href="/admin/games"><button type="button" class="btn btn-secondary">Cancel</button></a>
                    <form action="/admin/games" method="POST">
                        @csrf
                        <button class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </form>
    </div>

@endsection
