@extends('layouts.layout')
@section('content')

    <div class="container mt-5">
        <h2><b>Transaction Page</b></h2>
        <form action="/cart" method="POST">
            @csrf
            @method('delete')

            <div class="row">
                <div class="form-group col mb-3">
                    <label class="form-label" for="card_name">Card Name</label>
                    <input class="form-control" type="text" name="card_name" id="card_name" placeholder="Card Number"
                        required>
                </div>
                <div class="form-group col mb-3">
                    <label class="form-label" for="card_number">Card Number</label>
                    <input class="form-control" type="text" name="card_number" id="card_number"
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
                    <input class="form-control" type="number" name="CVC_CVV" id="CVC_CVV" placeholder="3 or 4 digit number"
                        required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-8 mb-3">
                    <label for="state">State</label>
                    <select id="state" class="form-control">
                        <option value="Indonesia" selected>Indonesia</option>
                        <option value="Argentina">Argentina</option>
                        <option value="USA">USA</option>
                        <option value="Germany">Germany</option>
                        <option value="England">England</option>
                    </select>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="postalCode">ZIP</label>
                    <input type="number" class="form-control" id="postalCode" name="postalCode" placeholder="ZIP">
                  </div>
            </div>
            
            <div class="row">
                <div class="col form-group mb-3">
                    <p>Total Price: <b>{{$totalPrice}}</b></p>
                    <button class="btn btn-secondary">Cancel</button>
                    <form action="/cart/transaction" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-success">Checkout</button>
                    </form>
                </div>
            </div>
        </form>
    </div>

@endsection
