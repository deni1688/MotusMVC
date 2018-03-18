<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row align-items-center">
        <div class="col">
            <h1><?php echo $data['post']->title; ?></h1>
            <small>By <?php echo $data['author']->name; ?>
                on <?php echo date('d/m/Y', strtotime($data['post']->created_at)); ?></small>
        </div>
        <div class="col">
            <a href="<?php echo URLROOT; ?>/posts" class="btn btn-primary pull-right">
                <i class="fa fa-angle-double-left mr-2"></i> Back
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <p><?php echo $data['post']->body; ?></p>
            <?php if ($data['post']->user_id == $_SESSION['user_id']): ?>
                <hr>
                <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-warning float-right"><i
                            class="fa fa-edit mr-2"></i>Edit Post</a>
                <form class="form-inline pull-right mr-2" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST">
                    <button class="btn btn-danger"><i class="fa fa-trash mr-2"></i>Delete</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>