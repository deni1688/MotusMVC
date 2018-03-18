<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="card-body bg-light">
        <h1 class="h4">Add Post</h1>
        <form action="<?php echo URLROOT; ?>/posts/add" method="POST">
            <div class="form-group">
                <label for="title">Title <sup>*</sup></label>
                <input
                        type="text"
                        name="title"
                        class="form-control from-control-lg <?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $data['title']; ?>"
                >
                <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
            </div>
            <div class="form-group">
                <label for="body">Content <sup>*</sup></label>
                <textarea
                        name="body"
                        class="form-control <?php echo (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>"
                        rows="8" ><?php echo $data['body']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
            </div>
            <div class="row">
                <div class="col">
                    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-dark btn-block">
                        Cancel
                    </a>
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-success btn-block" value="Publish">
                </div>
            </div>
        </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>