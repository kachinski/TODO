<div class="container">
    <a class="btn btn-success mt-5" href="/todo/list"><< Back to TODO list</a>
    <form class="mt-5 mb-5" method="POST" action="/admin/login">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" placeholder="Login" name="login" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
