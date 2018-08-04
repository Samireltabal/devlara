<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
<table class="table table-striped table-sm table-bordered table-hover table-inverse} table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>#id</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Rate</th>
            <th>Entitlements</th> 
            <th>Info</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td scope="row">{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->phone }}</td>
                <td>{{ $employee->rate }} {{ __("EGP") }}</td>
                    <td>
                        {{ getEntitlements($employee->id) }}  {{ __("EGP") }}
                    </td>
                    <td>{{ $employee->info }}</td> 
                    <td>
                        <form class='inline' id="deleteEmp-{{ $employee->id }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $employee->id }}">    
                            <button type="submit" class='btn btn-danger btn-sm'><i class="fa fa-remove" aria-hidden="true"></i></button>
                        </form>  
                        <button type="submit" onclick='pay("{{ $employee->name }}","{{ $employee->id }}")' class='btn btn-success btn-sm'><i class="fa fa-dollar" aria-hidden="true"></i></button>
                        <script>
                            function pay(name,id) {
                                var route = "{{ route('emp.add.entitlements',':id') }}";
                                route = route.replace(':id', id);
                                swal({
                                    title: 'Add Payment To' + name,
                                    input: 'text',
                                    inputAttributes: {
                                        autocapitalize: 'off'
                                    },
                                    showCancelButton: true,
                                    confirmButtonText: 'Submit Payment',
                                    showLoaderOnConfirm: true,
                                    preConfirm: (payment) => {
                                        $.ajax({
                                    type: "post",
                                    url: route,
                                    data: {
                                        '_token': "{{ csrf_token() }}",
                                        'paid': payment,
                                    },
                                    dataType: "JSON"
                                    })
                                        .then(response => {
                                            if (!response.ok) {
                                            throw new Error(response.statusText)
                                            }
                                            return response.json()
                                        })
                                        
                                    }
                                    }).then((result) => {
                                    if (result.value) {
                                        swal({
                                            type: 'success',
                                            title: 'Good',
                                            text: 'Payment Was Added ..',
                                        })
                                        listEmployee();

                                    }
                                    })
                            }
                        </script>
                        <script>
                            $('#deleteEmp-{{ $employee->id }}').on('submit', function(e) {
                                e.preventDefault();
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
                                    type: "delete",
                                    url: "{{ route('emp.delete') }}",
                                    data: $('#deleteEmp-{{ $employee->id }}').serialize(),
                                    dataType: "JSON",
                                    success: function(response){
                                        listEmployee();
                                        toast("{{__('Success')}}","{{ __('Employee Removed Successfully') }}","red","fa fa-plus-square-o",false,'topRight');

                                    }
                                });
                                        swal(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        );
                                    }
                                    })
                                
                            });
                        </script>
                    </td>           
                </tr>
            @endforeach
        </tbody>
</table>    
