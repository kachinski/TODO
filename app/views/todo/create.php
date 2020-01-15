<div class="container">
    <a class="btn btn-success mt-5" href="/todo/list"><< Back to TODO list</a>
    <form class="mt-5 mb-5" method="POST" action="/todo/store">
        <div class="form-group">
            <label for="user">User</label>
            <input type="text" class="form-control" id="user" placeholder="Please enter your username" name="user" maxlength="255" pattern="^[a-zA-Z]+$" required>
            <small class="form-text text-muted">Only latin letters without any other symbols and whitespaces</small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" maxlength="255" required>
        </div>
        <div class="form-group">
            <label for="text">Comment</label>
            <textarea class="form-control" id="text" rows="3" name="text" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
