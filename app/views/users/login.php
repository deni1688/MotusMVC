<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <?php flash('auth_notification'); ?>
            <div class="card mt-5">
                <div class="card-body bg-light">
                    <h4>Login to Account</h4>
                    <form action="<?php echo URLROOT; ?>/users/login" method="POST">
                        <div class="form-group">
                            <label for="email">Email <sup>*</sup></label>
                            <input
                                    type="email"
                                    name="email"
                                    class="form-control from-control-lg <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $data['email']; ?>"
                            >
                            <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <sup>*</sup></label>
                            <input
                                    type="password"
                                    name="password"
                                    class="form-control from-control-lg <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>"
                                    value="<?php echo $data['password']; ?>"
                            >
                            <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-success btn-block" value="Login">
                            </div>
                            <div class="col">
                                <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">
                                    Not yet a member? Register
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>