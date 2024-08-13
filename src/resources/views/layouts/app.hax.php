<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="<?=csrf_token()?>">

  <title>SPM | Starter</title>

  <!-- Styles -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  {{ css(['plugins/fontawesome-free/css/all.min.css', 'css/adminlte.min.css', 'css/kbt.css']) }}

  @yield('styles')
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.partials.nav-bar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">SPM Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ $request->user()->avatar() }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('edit-info/' . $request->user()->id) }}" class="d-block">{{ $request->user()->fullname }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @include('layouts.partials.side-bar')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @section('content-header')
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Starter Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div><!-- /.col -->
            @endsection
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Powered By YUGA
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ date('Y') }} <a href="http://kbt.spm">spm.com</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
@yield('modals')
<!-- REQUIRED SCRIPTS -->

<script>
    var BASE_URL = '<?=host()?>';
</script>
{{ script(['plugins/jquery/jquery.min.js', 'plugins/bootstrap/js/bootstrap.bundle.min.js']) }}



{{ script(['js/adminlte.min.js', 'js/number.min.js']) }}
@yield('scripts')

{{ script(['js/main.js']) }}

@yield('page-scripts')


</body>
</html>
