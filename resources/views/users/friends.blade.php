@extends('layouts.layout')
@section('content')

    <div class="container mt-5 border border-secondary rounded">
        <div class="row">
            <div class="col-3 py-2 border border-secondary border-left-0 border-top-0 border-bottom-0">
                <ul class="list-unstyled">
                    <li><a href="/profile" class="text-dark active">Profile</a></li>
                    @if ($user->role == 'Member')
                        <li><a href="/friends" class="text-dark">Friends</a></li>
                        <li><a href="/transactions" class="text-dark">Transaction History</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-9 py-2">
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
                <h3><b>Friends</b></h3>
                <div id="add-friend-container" class="row container-fluid px-0 mb-3">
                    <form action="/friends" method="POST" class="col">
                        @csrf
                        <label class="form-label d-block" for="username"><b>Add Friends</b></label>
                        <div class="d-inline form-inline">
                            <input class="form-control " type="text" name="username" id="username" placeholder="Username">
                            <button class="btn btn-outline-success d-inline">Add Friend</button>
                        </div>
                    </form>
                </div>
                <div id="incoming-friend-req-container" class="mb-3">
                    <p><b>Incoming Friend Request</b></p>
                </div>
                <div id="pending-friend-req-container" class="mb-3">
                    <p><b>Pending Friend Request</b></p>
                </div>
                <div id="your-friends-container" class="mb-3">
                    <p><b>Your Friends</b></p>
                    @if ($myFriends !=null || count($myFriends) > 0)
                        @foreach ($myFriends as $myFriend)
                            @if ($user->id == $myFriend->friend1_id)
                                <b>{{$myFriend->otherFriend->id}}</b>
                                {{$myFriend->friend2_id}}
                            @elseif ($user->id == $myFriend->friend2_id)
                                {{$myFriend->friend1_id}}
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
