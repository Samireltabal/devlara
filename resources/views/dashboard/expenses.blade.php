<a id="addExpense" class="btn btn-warning btn-lg btn-block" href="#" role="button" style="margin:0.5em 0;">{{__("Add Expense")}}</a>
<div class='expenseForm' style='display:none;'>
<form action="{{ route('expense.create') }}" id='ExpenseFormCreate' method="post">
    <div class="form-group">
      <label for="expdest">{{__("Expense Destination")}}</label>
      <input type="text" class="form-control" name="expdest" id="expdest" aria-describedby="expDest" placeholder="Expense Destionation" required>
      <small id="expDest" class="form-text text-muted">Expense Destination Auto Complete If predefined</small>
    </div>
    <div class="form-group">
      <label for="total">{{__("Money Paid")}}</label>
      <input type="text" name="total" id="total" class="form-control" placeholder="Money Paid" aria-describedby="helpId" required>
      <small id="helpId" class="text-muted">The total Ammount of money paid</small>
    </div>
    @csrf
    <div class="form-group">
      <label for="description">{{__("Description")}}</label>
      <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-success btn-lg btn-block" style="margin-bottom:4px;">{{__("Submit Expense")}}</button>
</form>

</div>
<script>
    $(function()
            {
     $('#addExpense').on('click' , function(e){
         e.preventDefault();
        $('.expenseForm').toggle('blind',400);
        });
            });
</script>
<script>
    $(function()
            {
                $( "#expdest" ).autocomplete({
                source: '{{route("expdest.list")}}',
                minLength: 3,
                
                select: function(event, ui) {
                    $('#expdest').val(ui.item.value);
                },                
                });
            });
</script>
<script>
        // Ajax Form Submit Item 
    
        $('#ExpenseFormCreate').on('submit', function(e) {
           e.preventDefault(); 
            var expdest = $('#expdest').val();
            var description = $('#description').val();
            var total = $('#total').val();
            
           $.ajax({
               type: "POST",
               url: "{{ route('expense.create') }}",
               data: {
                "expdest": expdest,
                "description": description,
                "total": total,
                "_token":	"{{ csrf_token() }}",
                },
               success: function() {
                document.getElementById("ExpenseFormCreate").reset(); 
                toast("{{__('Success')}}","{{ __('Expense Added Successfully') }}","green","fa fa-check-square-o",true,'topLeft');
               }
           });
       });
    </script>