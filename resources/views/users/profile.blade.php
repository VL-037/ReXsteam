@extends('layouts.layout')
@section('content')

    <div class="container mt-5 border border-secondary rounded">
        <div class="row">
            <div class="col-3 py-2 border border-secondary border-left-0 border-top-0 border-bottom-0">
                <ul class="list-unstyled">
                    <li><a href="/profile" class="text-dark active">Profile</a></li>
                    @if ($user->role == 'Member')
                        <li><a href="/friends" class="text-dark">Friends</a></li>
                        <li><a href="/transactionHistory" class="text-dark">Transaction History</a></li>
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
                <h3><b>{{ $user->username }} Profile</b></h3>
                <p><small>This infomation will be displayed publicity, so be careful what you share</small></p>
                <div id="profile-content">
                    <form action="/profile" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" type="text" name="username" id="username"
                                    value="{{ $user->username }}" disabled>
                            </div>
                            <div class="col">
                                <label class="form-label" for="level">Level</label>
                                <input class="form-control" type="text" id="level" value="{{ $user->level }}" disabled>
                            </div>
                            <div class="col">
                                <label for="urlPic">
                                    <img src="{{ $user->urlPic }}" alt="{{ $user->username }}_profile"
                                    class="rounded-circle border border-secondary" style="height: 10rem;">
                                </label>
                                <input type="file" name="urlPic" id="urlPic">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="fullname">Fullname</label>
                            <input class="form-control" type="text" name="fullname" id="fullname"
                                value="{{ $user->fullname }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="currPassword">Current Password</label>
                            <input class="form-control" type="password" name="currPassword" id="currPassword" required>
                            <p class="text-danger"><small>Fill out to confirm if you are authorized</small></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="newPassword">New Password</label>
                            <input class="form-control" type="password" name="newPassword" id="newPassword">
                            <p class="text-danger"><small>Only if you want to change password</small></p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="confNewPassword">Confirm New Password</label>
                            <input class="form-control" type="password" name="confNewPassword" id="confNewPassword">
                            <p class="text-danger"><small>Only if you want to change password</small></p>
                        </div>
                        <button class="btn btn-success float-right">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
