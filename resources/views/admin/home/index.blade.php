@extends('admin.layout.app')
@section('content')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
<div class="col-lg-12">
    <div class="col-lg-4">
            <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3 class="panel-title">{{ __("Check Warranty") }}</h3>
                    </div>
                    <div class="panel-body">
                    <form id='snCheck'>
                            <div class="form-group">
                              <label for="sn">Serial Number</label>
                              <input type="text" name="sn" id="sn" class="form-control" placeholder="Serial Number" aria-describedby="sn">
                              <small id="sn" class="text-muted">Serial Number check</small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Check</button>
                        </form>
                    </div>
                    <div class="panel-footer" id='snInquiry' style="display:none;">
                        
                    </div>
                  </div>
    </div>
    <div class="col-lg-4">
            <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title"> {{__("Check Quantity")}} </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                          <label for="product_name">Product name</label>
                          <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" aria-describedby="product_name">
                          <small id="product_name" class="text-muted">Product Quantity Search Auto Complete</small>
                        </div>                    
                    </div>
                    <div class="panel-footer" id='quan_check' style="display:none;">
                        <div id="available_quantity">
                        </div>
                        <button id="cancelQuantity" class='btn btn-danger btn-sm pull-right' style='margin-top:-2em;'><i class="fa fa-remove" aria-hidden="true"></i> Close</button>

                    </div>
                  </div>
        </div>
        <div class="col-lg-4">
                <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Panel title</h3>
                        </div>
                        <div class="panel-body">
                          Panel content
                        </div>
                      </div>
           </div>
            </div>
            <script>
                
 $(document).ready(function() {
     $('#snCheck').on('submit' , function(e){
        e.preventDefault();                    
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('sn.check') }}",
                        data: {
                            "sn": $('#sn').val(),
                            "_token" : "{{ csrf_token() }}"
                        },
                        dataType: 'html',
                        cache: false,
                        success: function(result){
                        $("#snInquiry").html(result);
                        $("#snInquiry").show('highlight',400);
                        },
                        });
                });    
     });
            </script>
            <script>
            $(function()
            {
                $( "#product_name" ).autocomplete({
                source: '{{route("sales.products.ac")}}',
                minLength: 3,
                select: function(event, ui) {
                    $('#quan_check').show('highlight',300);
                    $('#available_quantity').text('{{__("Available Quantity")}} : ' + ui.item.quantity + ' {{__("Piece")}}');
                }
                });
            });
            $('#cancelQuantity').on('click', function(event){
                event.preventDefault();
                $( "#product_name" ).val(' ');
                $('#quan_check').hide('highlight',300);
            })
            </script>
@endsection