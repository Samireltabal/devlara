@include('admin.layout.header')
@include('admin.layout.sidebar')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @include('admin.layout.footer')