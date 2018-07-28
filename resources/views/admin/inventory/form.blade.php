<div class="container">
<form method="POST" action="{{ route('inventory.create') }}">
        <div class="form-group">
            @csrf
            <label for="product_name" class="col-sm-12 col-form-label">Product name</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name">
                <small id="quantity" class="text-muted">Product Name Auto Complete</small>
                <input type="hidden" name="product_id" id="product_id">
            </div>
        </div>
        <div class="clearfix"></div>
        <fieldset class="form-group">
            <legend class="col-form-legend col-sm-8">Inventroy</legend>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="quantity">Quantity</label>
                  <input type="hidden" name="type" value='2'>
                  <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity" aria-describedby="quantity">
                  <small id="quantity" class="text-muted">Quantity</small>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="quantity">Price</label>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Price" aria-describedby="price">
                    <small id="price" class="text-muted">Price</small>
                  </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="quantity">Supplier</label>
                    <input type="text" name="supplier_name" id="Supplier" class="form-control" placeholder="Supplier Name" aria-describedby="Supplier">
                    <small id="Supplier" class="text-muted">Supplier name : Auto Complete</small>
                    <input type="hidden"  id='supplier_id' name="supplier_id">
                  </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Add Inventory</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(function(){
	 $( "#Supplier" ).autocomplete({
	  source: "{{ route('inventory.supplier') }}",
	  minLength: 3,
	  select: function(event, ui) {
	  	$('#Supplier').val(ui.item.value);
        $('#supplier_id').val(ui.item.id);
	  }
	});
});
$(function(){
	 $( "#product_name" ).autocomplete({
	  source: "{{ route('inventory.product') }}",
	  minLength: 3,
	  select: function(event, ui) {
	  	$('#product_name').val(ui.item.value);
        $('#product_id').val(ui.item.id);
	  }
	});
});
</script>