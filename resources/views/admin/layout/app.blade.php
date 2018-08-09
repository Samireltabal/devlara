@include('admin.layout.header')
@include('admin.layout.sidebar')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          @yield('title')
      </h1>
      <ol class="breadcrumb hide">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        
        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @include('admin.layout.footer')