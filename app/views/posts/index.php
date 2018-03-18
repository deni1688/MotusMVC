<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row align-items-center">
        <div class="col">
            <h1>Posts</h1>
        </div>
        <div class="col">
            <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-plus mr-2"></i> Add Post
            </a>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($data['posts'])): ?>
            <?php foreach ($data['posts'] as $post): ?>
                <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5><?php echo $post->title; ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="bg-light p-2">Written by <?php echo $post->name; ?>
                                on <?php echo date('d/m/Y', strtotime($post->postCreated)); ?></div>
                            <p><?php echo limit_text($post->body, 36); ?>...</p>
                            <a class="btn btn-dark pull-right mt-3"
                               href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <p>No posts at this time</p>
            </div>
        <?php endif; ?>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>