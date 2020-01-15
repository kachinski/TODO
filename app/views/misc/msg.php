<div class="container">
    <h1 class="mb-5 mt-5 text-center text-uppercase"><?php echo $title; ?></h1>
    
    <?php if (isset($description)): ?>
        <h5 class="mb-5 mt-5 text-center text-uppercase"><?php echo $description; ?></h5>
    <?php endif; ?>

    <div class="d-flex justify-content-center">
        <a class="btn btn-primary" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
    </div>
</div>
