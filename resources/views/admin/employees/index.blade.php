@extends('admin.layout.app')
@section('title')
    Employees
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <span class='pull-right'>
            <a name="addEmployee" id="addEmployee" class="btn btn-success" href="#" role="button"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Employee</a>
        </span>
    </div> 
    <div class="box-body" id='FormEmployee' style="display:none;">
        @include('admin.employees.form')
    </div> 
    <div class="box-body">
        <div class="col-lg-12" class='box' id="employeesList">
                <div id="loading" class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                </div>    
        </div>
    </div>
    
</div>
<script>
    $(document).ready(function(){
        listEmployee();
        $('#addEmployee').on('click', function(){
            $('#FormEmployee').toggle('blind',200);
        })
    });
    function listEmployee() {
        $.ajax({
            type: 'GET',
            url: "{{ route('emp.list') }}",
            dataType: 'html',
            success: function(response) {
                $("#employeesList").html(response);
                $('#FormEmployee').hide('blind',200);
            }
        });
    }
</script>
@endsection