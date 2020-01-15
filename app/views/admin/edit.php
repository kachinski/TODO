<div class="container">
    <a class="btn btn-success mt-5" href="/todo/list"><< Back to TODO list</a>
    <form class="mt-5 mb-5" method="POST" action="/admin/update">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="user">User</label>
            <input type="text" class="form-control" id="user" name="user" value="<?php echo $data['user']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="text">Comment</label>
            <textarea class="form-control" rows="3" id="text" name="text" required><?php echo $data['todo']; ?></textarea>
        </div>
        <div class="custom-control custom-switch mb-3">
            <input type="checkbox" class="custom-control-input" id="toggle" name="toggle" <?php echo $data['status'] ? 'checked' : ''; ?>>
            <label class="custom-control-label" for="toggle">Mission accomplished😋</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
