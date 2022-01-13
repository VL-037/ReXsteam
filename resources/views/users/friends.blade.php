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
                    @if (count($incomingFriendRequests) == 0)
                        <p class="text-success"><small>You have no Incoming Request</small></p>
                    @else
                        <ul class="row">
                            @foreach ($incomingFriendRequests as $incomingReq)
                                <li class="list-unstyled mb-3 col">
                                    <div class="card p-2" style="width: 15rem;">
                                        <p class="my-0">{{ $incomingReq->fullname }}</p>
                                        <p class="text-secondary"><small>{{ $incomingReq->role }}</small></p>
                                        <div class="d-flex justify-content-between">
                                            <form action="/friends/incoming/{{ $incomingReq->id }}" method="POST">
                                                @csrf
                                                <button class="btn btn-success">Accept</button>
                                            </form>
                                            <form action="/friends/incoming/{{ $incomingReq->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Reject</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div id="pending-friend-req-container" class="mb-3">
                    <p><b>Pending Friend Request</b></p>
                    @if (count($pendingFriendRequests) == 0)
                        <p class="text-success"><small>You have no Incoming Request</small></p>
                    @else
                        <ul class="row">
                            @foreach ($pendingFriendRequests as $pendingReq)
                                <li class="list-unstyled mb-3 col">
                                    <div class="card p-2" style="width: 15rem;">
                                        <p class="my-0">{{ $pendingReq->fullname }}</p>
                                        <p class="text-secondary"><small>{{ $pendingReq->role }}</small></p>
                                        <div class="d-flex justify-content-center">
                                            <form action="/friends/pending/{{ $pendingReq->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-warning">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div id="your-friends-container" class="mb-3">
                    <p><b>Your Friends</b></p>
                    @if ($myFriends == null || count($myFriends) == 0)
                        <p class="text-success"><small>You have no friends LMAO</small></p>
                    @else
                        <ul class="row">
                            @foreach ($myFriends as $myFriend)
                                <li class="list-unstyled mb-3 col">
                                    <div class="card p-2" style="width: 15rem;">
                                        <div class="d-flex">
                                            <img src="{{ $myFriend->urlPic }}" alt="{{ $myFriend->username }}_profile" class="rounded mr-2"
                                                style="width: 3rem;">
                                            <div class="profile-header">
                                                <p class="my-0">{{ $myFriend->fullname }}</p>
                                                <p class="text-secondary"><small>{{ $myFriend->role }}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
