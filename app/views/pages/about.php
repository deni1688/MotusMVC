<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-4"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['desc']; ?></p>
            <p class="lead"><strong>Version: <?php echo APPVERSION; ?></strong></p>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>