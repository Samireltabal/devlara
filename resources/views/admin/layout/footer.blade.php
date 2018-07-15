 <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
@include('admin.layout.aditionalSidebar')
  <!-- /.control-sidebar -->
  
</div>
<!-- ./wrapper -->
 
<script>
      var menuId = '#{{  str_slug(Route::getFacadeRoot()->current()->getName()) }}';
    var li = $(menuId).closest(".treeview");

    $(menuId).addClass('active');
    $(li).addClass('active');

</script>
</body>
</html>