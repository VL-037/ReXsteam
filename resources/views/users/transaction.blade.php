@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
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
        <h2><b>Transaction Page</b></h2>
        <form action="/cart/transaction" method="POST">
            @csrf

            <div class="row">
                <div class="form-group col mb-3">
                    <label class="form-label" for="name">Card Name</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Card Name"
                        required>
                </div>
                <div class="form-group col mb-3">
                    <label class="form-label" for="number">Card Number</label>
                    <input class="form-control" type="text" name="number" id="number"
                        placeholder="0000 0000 0000 0000" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col mb-3">
                    <label class="form-label" for="expiredDateM">Expired Date (Month)</label>
                    <input class="form-control" type="text" name="expiredDateM" id="expiredDateM" placeholder="MM"
                        required>
                </div>
                <div class="form-group col mb-3">
                    <label class="form-label" for="expiredDateY">Expired Date (Year)</label>
                    <input class="form-control" type="text" name="expiredDateY" id="expiredDateY" placeholder="YYYY"
                        required>
                </div>
                <div class="form-group col mb-3">
                    <label class="form-label" for="CVC_CVV">CVC / CVV</label>
                    <input class="form-control" type="text" name="CVC_CVV" id="CVC_CVV"
                        placeholder="3 or 4 digit number" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-8 mb-3">
                    <label for="country">Country</label>
                    <select id="country" name="country" class="form-control">
                        <option value="Indonesia" selected>Indonesia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="USA">USA</option>
                        <option value="Germany">Germany</option>
                        <option value="England">England</option>
                    </select>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="postalCode">ZIP</label>
                    <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="ZIP">
                </div>
            </div>

            <div class="row">
                <div class="col form-group mb-3">
                    <p>Total Price: <b>{{ $totalPrice }}</b></p>
                    <a href="/cart"><button type="button" class="btn btn-secondary">Cancel</button></a>
                    <button class="btn btn-success" type="submit">Checkout</button>
                </div>
            </div>
        </form>
    </div>

@endsection
