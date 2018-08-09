<?php 
    $employees_list = $employees::all();
    $attArray = $attendances::where('shift_id','=',get_shift())->get();
?>
@foreach($employees_list as $employee)
    @if( ! $employee->attended())
    <div class="info-box col-lg-3">
        <!-- Apply any bg-* class to to the icon to color it -->
        <span class="info-box-icon bg-red"><i class="fa fa-user-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">{{ $employee->name }}</span>
          <span class="info-box-number">{{ $employee->rate }} / Day</span>
        <span> <a id="emp-{{ $employee->id }}" class="btn btn-success btn-large pull-right">Attended</a> </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      <script>
          $('#emp-{{ $employee->id }}').on('click', function(e) {
              e.preventDefault();
              $.ajax({
                    type: "POST",
                    url: "{{ route('emp.attend') }}",
                    data: {
                        'id': '{{ $employee->id }}',
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: "JSON",
                    success: function(response){
                        $('#attendances_list').html('Loading..');
                        load_attendances();
                    }
                });
          });
      </script>
    @endif
@endforeach
