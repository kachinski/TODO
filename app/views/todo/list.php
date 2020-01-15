<div class="container">

    <div class="d-flex justify-content-center justify-content-sm-end mt-5">
        <a class="btn btn-success mr-3" href="/todo/create">+ Add New TODO</a>
        <?php if ($admin): ?>
            <a class="btn btn-success" href="/admin/logout">Logout</a>
        <?php else: ?>
            <a class="btn btn-success" href="/admin/login">Control Panel</a>
        <?php endif; ?>
    </div>

    <div class="mb-5 mt-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="d-flex mb-5 mb-sm-0 justify-content-center justify-content-sm-start">
                    <a class="btn btn-primary mr-3" href="/todo/list?page=<?php echo $currentPage; ?>&sort=id&order=<?php echo $orderNext; ?>" role="button">By ID</a>
                    <a class="btn btn-primary mr-3" href="/todo/list?page=<?php echo $currentPage; ?>&sort=user&order=<?php echo $orderNext; ?>" role="button">By User</a>
                    <a class="btn btn-primary mr-3" href="/todo/list?page=<?php echo $currentPage; ?>&sort=email&order=<?php echo $orderNext; ?>" role="button">By Email</a>
                    <a class="btn btn-primary" href="/todo/list?page=<?php echo $currentPage; ?>&sort=status&order=<?php echo $orderNext; ?>" role="button">By Status</a>
                </div>
            </div>
            <div class="col-sm-6">

                <?php require_once 'list_pagination.php'; ?>

            </div>
        </div>
    </div>

    <?php foreach ($data as $todo): ?>

        <div class="bg-light border <?php echo $todo['status'] ? 'border-success' : ''; ?> p-3 mb-3">

            <?php if($admin): ?>
                <p><a class="btn btn-primary" href="/admin/edit?id=<?php echo $todo['id']; ?>" role="button">Edit</a></p>
            <?php endif; ?>

            <p class="d-flex">
                <span class="font-weight-bold text-uppercase" style="width: 6rem">Id</span>
                <span class="text-capitalize"><?php echo $todo['id']; ?></span>
            </p>
            <p class="d-flex">
                <span class="font-weight-bold text-uppercase" style="width: 6rem">User</span>
                <span class="text-capitalize"><?php echo $todo['user']; ?></span>
            </p>
            <p class="d-flex">
                <span class="font-weight-bold text-uppercase" style="width: 6rem">Email</span>
                <a href="mailto:<?php echo $todo['email']; ?>"><?php echo $todo['email']; ?></a>
            </p>
            <p class="d-flex">
                <span class="font-weight-bold text-uppercase" style="width: 6rem">Status</span>
                <?php echo $todo['status'] ? 'Completed' : 'Not&nbsp;completed' ?>
            </p>
            <p class="d-flex <?php echo $todo['admin'] ? '' : 'mb-0'; ?>">
                <span class="font-weight-bold text-uppercase" style="width: 6rem">Comment</span>
                <?php echo $todo['todo']; ?>
            </p>
            <?php if ($todo['admin']): ?>
                <p class="text-info font-italic font-weight-bold text-uppercase mb-0" style="text-decoration: underline">Edited by Admin</p>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>

</div>
