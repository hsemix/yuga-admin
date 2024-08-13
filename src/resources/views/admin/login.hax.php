<?= $this->extend('layouts.base-logged-out') ?>
<?= $this->section('content') ?>
<div class="card card-outline card-primary">
    <div class="card-header text-center d-none">
        <div class="h1"><img src="<?= host('assets/images/192.png') ?>" class="my-1" alt="YUGA-ADMIN LOGO" style="max-height: 100px;"><br><b>Mcash</b>Pay</div>
    </div>
    <div class="card-body">

        <form action="{{ host('admin/auth/login') }}" method="post">

            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            

            <div class="row">
                <?php if (!isset($email)) { ?>
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                <?php } ?>
                <!-- /.col -->
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-block"><?= isset($email) ? 'Submit OTP' : 'Sign In' ?></button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <?= session('flash_message') ?>
        <p class="my-3">
            <?php if (!isset($email)) { ?>
                <a href="<?= host('forgot-password') ?>">I forgot my password</a>
            <?php } else { ?>
                Return to <a href="<?= host('login') ?>">login</a>
            <?php } ?>
        </p>
        <!-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<?= $this->endSection() ?>
