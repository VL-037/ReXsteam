<form action="/auth" method="POST">
    @csrf
    @if (session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <label for="username">Username</label>
    <input type="text" name="username" id="username"><br>

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <button type="submit">Submit</button>
</form>
