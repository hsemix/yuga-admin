<?= $this->extend('layouts/generic-out') ?>

<?=$this->section('body')?>
<body class="hold-transition login-page">
    <div class="login-box">
        <?=view('layouts/partials/_notifications')?>
        @yield('content')
    </div>
    <!-- /.login-box -->
    <script>
        var HOST_URL = '<?=host()?>'
    </script>
    <!-- jQuery -->
    <script src="<?= host('vendor/yuga/admin/assets/theme/admin-lte/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= host('vendor/yuga/admin/assets/theme/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= host('vendor/yuga/admin/assets/theme/admin-lte/dist/js/adminlte.min.js') ?>"></script>

        <!-- Toastr  -->
        <script src="<?=host('vendor/yuga/admin/assets/theme/admin-lte/plugins/toastr/toastr.min.js')?>"></script>
    <script src="<?=host('vendor/yuga/admin/assets/theme/admin-lte/plugins/toastr/toastr_custom.js')?>"></script>

    <script src="<?= host('vendor/yuga/admin/assets/custom/js/main.js') ?>"></script>
    <script src="<?= host('vendor/yuga/admin/assets/custom/js/login.js') ?>"></script>
</body>
<?=$this->endSection()?>