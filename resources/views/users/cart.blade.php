@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <h2><b>Shopping Cart</b></h2>
        @foreach ($games as $game)
            <div class="card rounded py-2">
                <div class="justify-content-between">
                    <div class="d-flex game-content">
                        <img style="height: 10vw"
                            src="https://mobitekno.com/wp-content/uploads/2017/12/20171108094330_Review_Cover_Fire__Game_Action_Untuk_Fans_Militer_Modern-768x432.jpg"
                            alt="cart_item_image" class="mx-2">
                        <div class="game-detail">
                            <div class="d-flex">
                                <h4><b>{{ $game->name }}</b></h4>
                            </div>
                            <p><small>{{ $game->category->name }}</small></p>
                            <p><small><b>Rp. {{ $game->price }}</b></small></p>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#{{ $game->game_id }}">
                                Delete
                            </button>
                            <div class="modal fade" id="{{ $game->game_id }}" tabindex="-1" role="dialog"
                                aria-labelledby="{{ $game->name }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="{{ $game->name }}">Delete Cart Item</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <b>{{ $game->name }}</b> from your cart?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <form action="/cart/{{ $game->id }}" method="POST">
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
                </div>
            </div>
        @endforeach
        <div class="card rounded p-2">
            <div id="total-price">
                Total Price:
                <p><b>
                        Rp.
                        @if (count($games) <= 0)
                            {{ 0 }}
                        @else
                            @if (count($games) == 1)
                                {{ $games[0]->price }}
                            @else
                                @for ($i = 0; $i < count($games) - 1; $i++)
                                    {{ $games[$i]->price += $games[$i + 1]->price }}
                                @endfor
                            @endif
                        @endif
                    </b></p>
            </div>
            <button class="btn btn-success mr-auto" {{count($games) > 0 ? '' : 'disabled'}}>Checkout</button>
        </div>
    </div>

@endsection
