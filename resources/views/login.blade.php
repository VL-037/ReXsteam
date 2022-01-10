<form action="/auth" method="POST">
    @csrf
    <label for="username">Username</label>
    <input type="text" name="username" id="username"><br>

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <button type="submit">Submit</button>
</form>
