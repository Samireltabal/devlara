<form id='CreateEmpForm'>
    @csrf
    <div class="form-group">
      <label for="name">Name :</label>
      <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Name">
      <small id="name" class="form-text text-muted">Enter The Employee Name</small>
    </div>
    <div class="form-group">
      <label for="phone">Phone Number :</label>
      <input type="tel"
        class="form-control" name="phone" id="phone" aria-describedby="phone" placeholder="Phone Number">
      <small id="phone" class="form-text text-muted">Phone Number</small>
    </div>
    <div class="form-group">
      <label for="rate">Rate :</label>
      <input type="number"
        class="form-control" name="rate" id="rate" aria-describedby="rate" placeholder="Rate / Day">
      <small id="rate" class="form-text text-muted">Salary per Day</small>
    </div>
    <div class="form-group">
      <label for="info">Information</label>
      <textarea class="form-control" name="info" id="info" rows="3"></textarea>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Employee</button>
    </div>
</form>
<script>
    $('#CreateEmpForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('emp.create') }}",
            data: $('#CreateEmpForm').serialize(),
            dataType: "JSON",
            success: function(response){
                listEmployee();
                toast("{{__('Success')}}","{{ __('Employee Added Successfully') }}","green","fa fa-plus-square-o",false,'topRight');

            }
        })
    });
</script>