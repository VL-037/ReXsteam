<form action="/register" method="POST">
    @csrf
    <label for="username">Username</label>
    <input type="text" name="username" id="username"><br>

    <label for="fullname"> Fullname</label>
    <input type="text" name="fullname" id="fullname"><br>

    <label for="password">Password</label>
    <input type="password" name="password" id="password"><br>

    <label for="fullname"> Role</label>
    <select name="role" id="role">
        <option value="Member">Member</option>
        <option value="Admin">Admin</option>
    </select>

    <button type="submit">Submit</button>
</form>
