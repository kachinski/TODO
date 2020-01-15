<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center justify-content-sm-end mb-0">

        <!-- Previous -->

        <?php if ($currentPage > 1): ?>

            <li class="page-item"><a class="page-link" href="/todo/list?page=1&sort=<?php echo $sort; ?>&order=<?php echo $orderCurrent; ?>">First</a></li>

        <?php else: ?>

            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">First</a></li>

        <?php endif; ?>

        <!-- // -->

        <?php echo $currentPage - 2 > 0 ? '<li class="page-item"><a class="page-link" href="/todo/list?page=' . ($currentPage - 2) . '&sort=' . $sort . '&order=' . $orderCurrent . '">' . ($currentPage - 2) . '</a></li>' : ''; ?>
        <?php echo $currentPage - 1 > 0 ? '<li class="page-item"><a class="page-link" href="/todo/list?page=' . ($currentPage - 1) . '&sort=' . $sort . '&order=' . $orderCurrent . '">' . ($currentPage - 1) . '</a></li>' : ''; ?>

        <!-- Current -->

        <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $currentPage; ?><span class="sr-only">(current)</span></span></li>

        <!-- // -->

        <?php echo $currentPage + 1 <= $allPages ? '<li class="page-item"><a class="page-link" href="/todo/list?page=' . ($currentPage + 1) . '&sort=' . $sort . '&order=' . $orderCurrent . '">' . ($currentPage + 1) . '</a></li>' : ''; ?>
        <?php echo $currentPage + 2 <= $allPages ? '<li class="page-item"><a class="page-link" href="/todo/list?page=' . ($currentPage + 2) . '&sort=' . $sort . '&order=' . $orderCurrent . '">' . ($currentPage + 2) . '</a></li>' : ''; ?>

        <!-- Next -->

        <?php if ($currentPage < $allPages): ?>

            <li class="page-item"><a class="page-link" href="/todo/list?page=<?php echo $allPages; ?>&sort=<?php echo $sort; ?>&order=<?php echo $orderCurrent; ?>">Last</a></li>

        <?php else: ?>

            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Last</a></li>

        <?php endif; ?>

        <!-- // -->

    </ul>
</nav>
