<h1>{{__("Sales")}}</h1>
<form id='submitItem'>
     {{-- hidden inputs --}}
     <div class="col-lg-12">
        <h5 class='pull-right'><span id='available_quantity'></span></h5>  
          
     </div>
    <input type="hidden" id='shift_id' name="shift_id" value="{{ get_shift() }}">
    <input type="hidden" id='invoice_id' name="invoice_id" value="{{ $current_invoice["id"] }}">
    <input type="hidden" name="product_id" id="product_id">
    <div class="form-group col-lg-12">
        @csrf
      <label for="barcode"><i class="fa fa-barcode" aria-hidden="true"></i> {{__("Barcode")}}</label>
      <input type="text" class="form-control" name="barcode" id="product_barcode" aria-describedby="BarcodeHelp" placeholder="Barcode" autofocus>
      <small id="BarcodeHelp" class="form-text text-muted">{{__("Scan Barcode")}}</small>
    </div>
    <div class="form-group col-lg-12">
        <label for="barcode">{{__("Product name")}}</label>
        <input type="text" class="form-control" name="product_name" id="product_name" aria-describedby="product_nameHelp" placeholder="Product Name">
        <small id="product_nameHelp" class="form-text text-muted">{{__("Search Product By name")}}</small>
    </div>
    <div class="form-group col-lg-6">
        <label for="barcode">{{__("Product price")}}</label>
        <input type="text" class="form-control" name="product_price" id="product_price" aria-describedby="product_priceHelp" placeholder="Product Price">
        <small id="product_priceHelp" class="form-text text-muted">{{__("Price")}}</small>
    </div>
    <div class="form-group col-lg-6">
        <label for="product_quantity">{{__("Product Quantity")}}</label>
        <input type="text" class="form-control" name="product_quantity" id="product_quantity" aria-describedby="product_quantityHelp" placeholder="Product Quantity">
        <small id="product_quantityHelp" class="form-text text-muted">{{__("Quantity")}}</small>
    </div>
    <div class="form-group col-lg-6">
        <label for="product_quantity">{{__("Discount")}} %</label>
        <input type="text" class="form-control" name="discount" id="discount" aria-describedby="product_quantityHelp" placeholder="Discount %">
        <small id="product_quantityHelp" class="form-text text-muted">{{__("Discount")}} %</small>
    </div>
    <div class="form-group col-lg-6">
        <label for="product_quantity">{{__("Discounted price")}}</label>
        <input type="text" class="form-control" name="discounted_price" id="discounted_price" aria-describedby="product_quantityHelp" placeholder="Final Price">
        <small id="product_quantityHelp" class="form-text text-muted">{{__("Discounted price")}}</small>
    </div>
    <div class="form-group col-lg-12">
            <label for="sn">{{__("Serial Number")}}</label>
            <input type="text" class="form-control" name="sn" id="sn" aria-describedby="snHelp" placeholder="Serial Number">
            <small id="snHelp" class="form-text text-muted">{{__("Serial Number for the warranty")}}</small>
        </div>
        <input type="hidden" name="product_type" id='product_type'>
    <div class="form-group col-lg-6">
        <button type="submit"  class="btn btn-success btn-lg btn-block">{{__("Add Product")}}</button>
    </div>
    <div class="form-group col-lg-6">
        <button type="reset"  class="btn btn-warning btn-lg btn-block">{{__("Clear")}}</button>
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
                    $('#product_type').val(ui.item.type);                    
                    $('#product_quantity').val(1);
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
                    $('#product_type').val(ui.item.type);                    
                    $('#product_quantity').val(1);
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
<script>
    // Ajax Form Submit Item 
    $(function (){
        $('#discount').on('change', function () {
            var discount = $('#discount').val();
            var price = $('#product_price').val();
            console.log(discount);
            console.log(price);
            let discounted_price = (100 - discount) / 100 * price ;
            console.log(discounted_price);
            $('#discounted_price').val(discounted_price);
        })
    });
    $(function (){
        $('#discounted_price').on('change', function () {
            var discounted_price = $('#discounted_price').val();
            var price = $('#product_price').val();            
            console.log(discounted_price);
            console.log(price);
            let discount = 100 - (discounted_price  * 100) / price ;
            console.log(discount);
            $('#discount').val(discount);
        })
    });
    $('#submitItem').on('submit', function(e) {
       e.preventDefault(); 
        var product_id = $('#product_id').val();
        var invoice_id = $('#invoice_id').val();
        var shift_id = $('#shift_id').val();
        var product_price = $('#product_price').val();
        var product_type = $('#product_type').val();
        var sn = $('#sn').val();
        var discount = $('#discount').val();
        var product_quantity = $('#product_quantity').val();
        var discounted_price = $('#discounted_price').val();
        
       $.ajax({
           type: "POST",
           url: "{{ route('sales.submit') }}",
           data: {
            "shift_id": shift_id,
            "invoice_id": invoice_id,
            "product_id": product_id,
            "_token":	"{{ csrf_token() }}",
            "discount": discount,
            "discounted_price": discounted_price,
            "product_price": product_price,
            "product_type": product_type,
            "product_quantity": product_quantity,
            "sn": sn,
            },
           success: function() {
            loadContent('{{ $current_invoice["id"] }}');
            document.getElementById("submitItem").reset(); 
            $('#available_quantity').text(' ');
            toast("{{__('Success')}}","{{ __('Item Added Successfully') }}","green","fa fa-check-square-o",true,'topLeft');

           }
       });
   });
</script>