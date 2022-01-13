@extends('layouts.layout')
@section('content')

    <div class="container mt-5">

        <div class="mb-3">
            <h1>Transaction History</h1>
        </div>

        <div class="mb-3">
            @foreach ($transactionHeaders as $header)
                <p><b>Transaction Id: {{ $header->id }}</b></p>
                <P>Purchase Date: {{ $header->created_at }}</P>
                <div class="container-fluid">
                    @foreach ($transactionDetails as $detail)
                        @if ($detail->transaction_header_id == $header->id)
                            <ul class="row">
                                @foreach ($games as $game)
                                    @if ($game->id == $detail->game_id)
                                        <li class="list-unstyled mb-3 col">
                                            <div class="card mb-2 text-center" style="width: 15rem;">
                                                <img src="{{ $game->cover }}" alt="" class="">
                                                <p>{{ $game->name }}</p>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </div>
                <p>total price: <b>{{ $header->totalPrice }}</b></p>
                <hr class="border border-dark">
            @endforeach
        </div>
    </div>

@endsection
