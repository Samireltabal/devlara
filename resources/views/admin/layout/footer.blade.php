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
<script>	
  function confirmDelete(element) {
    var instance =  document.getElementById(element);
    $(instance).click(function( event ) {
        event.preventDefault();
        var theurl = $(this).attr('link');
        swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.value) {
            $.ajax({
              type: 'delete',
              url: theurl,
              data: {
                "user_id": element,
                "_token": "{{ csrf_token() }}",
              },
              cache: false,
              success: function() {           
                swal(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                window.location.reload();
              }     
            })
            
          }
          })
    });	
  }
</script>
<script>
  function notification(type,message) {
    if(type == 'faild'){
    swal(
      'Something Went Wrong',
      message,
      'error'
    )
  } else if(type == 'success'){
    swal(
    'Good',
    message,
    'success'
  )
  } else if(type == 'warning'){
    swal( 'Warning..',
    message,
    'warning'
  )
  }
}
$("#barcode").JsBarcode("Hi!");
</script>
@include('inc.messages')
</body>
</html>