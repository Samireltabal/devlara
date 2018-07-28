<h1>{{__("Sales")}}</h1>
<form action="{{ route('sales.submit') }}" method="post" id='submitItem'>
     {{-- hidden inputs --}}
     <div class="col-lg-12">
        <h5 class='pull-right'><span id='available_quantity'></span></h5>  
          
     </div>
    <input type="hidden" name="shift_id" value="{{ get_shift() }}">
    <input type="hidden" name="invoice_id" value="{{ $current_invoice["id"] }}">
    <input type="hidden" name="product_id" id="product_id">
    <div class="form-group col-lg-12">
        @csrf
      <label for="barcode"><i class="fa fa-barcode" aria-hidden="true"></i> {{__("Barcode")}}</label>
      <input type="text" class="form-control" name="barcode" id="product_barcode" aria-describedby="BarcodeHelp" placeholder="Barcode">
      <small id="BarcodeHelp" class="form-text text-muted">Scan Barcode</small>
    </div>
    <div class="form-group col-lg-12">
        <label for="barcode">{{__("Product name")}}</label>
        <input type="text" class="form-control" name="product_name" id="product_name" aria-describedby="product_nameHelp" placeholder="Product Name">
        <small id="product_nameHelp" class="form-text text-muted">Search Product By name</small>
    </div>
    <div class="form-group col-lg-6">
        <label for="barcode">{{__("Product price")}}</label>
        <input type="text" class="form-control" name="product_price" id="product_price" aria-describedby="product_priceHelp" placeholder="Product Price">
        <small id="product_priceHelp" class="form-text text-muted">Price</small>
    </div>
    <div class="form-group col-lg-6">
        <label for="product_quantity">{{__("Product Quantity")}}</label>
        <input type="text" class="form-control" name="product_quantity" id="product_quantity" aria-describedby="product_quantityHelp" placeholder="Product Quantity">
        <small id="product_quantityHelp" class="form-text text-muted">Quantity</small>
    </div>
    <div class="form-group col-lg-6">
        <button type="submit"  class="btn btn-success btn-lg btn-block">Add Product</button>
    </div>
    <div class="form-group col-lg-6">
        <button type="reset"  class="btn btn-warning btn-lg btn-block">Clear</button>
    </div>
    
</form>

<script>
     $(function()
            {
                $( "#product_name" ).autocomplete({
                source: '{{route("sales.products.ac")}}',
                minLength: 3,
                select: function(event, ui) {
                    $('#product_id').val(ui.item.id);
                    $('#product_name').val(ui.item.value);
                    $('#product_price').val(ui.item.price);
                    $('#product_barcode').val(ui.item.barcode);
                    $('#available_quantity').text('{{__("Available Quantity")}} : ' + ui.item.quantity);
                }
                });
            });
            $(function()
            {
                $( "#product_barcode" ).autocomplete({
                source: '{{route("sales.barcode.ac")}}',
                minLength: 3,
                
                select: function(event, ui) {
                    $('#product_id').val(ui.item.id);
                    $('#product_barcode').val(ui.item.value);
                    $('#product_price').val(ui.item.price);
                    $('#product_name').val(ui.item.name);
                    $('#available_quantity').text('{{__("Available Quantity")}} : ' + ui.item.quantity);
                },
                response: function(event,ui) {
                    if (ui.content.length == 1)
                    {
                        ui.item = ui.content[0];
                        $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete('close');
                    }
                }
                
                
                });
            });
</script>