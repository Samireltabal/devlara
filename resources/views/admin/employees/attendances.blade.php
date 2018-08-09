@extends('admin.layout.app')
@section('title')
    Attendance
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        {{$shift->created_at}}
    </div> 
    
    <div class="box-body">
        <div class="col-lg-12" id="attendances_list">
            <div class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>
    
</div>
<script>
    $(document).ready( function() {
        load_attendances();
    })
    function load_attendances() {
        $.ajax({
            type: "get",
            url: "{{ route('emp.att.list') }}",
            dataType: "html",
            success: function(response){
                  $('#attendances_list').html(response);
            }
        })
    }
</script>
@endsection