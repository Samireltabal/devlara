@if($products->count())
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
                    <div class="col-lg-12">
                      
                      <table class="table table-striped table-sm table-bordered table-hover table-responsive">
                        <thead class="thead-default">
                          <tr>
                            <th>{{__("ID")}}</th>
                            <th>{{__("Name")}}</th>
                            <th>{{__("Selling Price")}}</th>
                          <th>{{ __("Category") }}</th>
                          <th>{{ __("Status") }}</th>
                          <th>{{ __("BarCode") }}</th>
                          <th>{{ __("Purchase Price") }} <small><sub> Average </sub></small></th>
                          <th>{{ __("Quantity Available") }}</th>
                          <th>{{ __("Type") }}</th>
                          <th>{{ __("Options") }}</th>
                          </tr>
                          </thead>
                          <tbody>
                            @foreach($products as $key=>$products_category)
                            <tr class="success">
                                <td colspan="20"> <h4 class='text-center'> {{ category_name($key) }} </h4></td>
                                <thead class="thead-default">
                                    <tr>
                                      <th>{{__("ID")}}</th>
                                      <th>{{__("Name")}}</th>
                                      <th>{{__("Selling Price")}}</th>
                                    <th>{{ __("Category") }}</th>
                                    <th>{{ __("Status") }}</th>
                                    <th>{{ __("BarCode") }}</th>
                                    <th>{{ __("Purchase Price") }} <small><sub> Average </sub></small></th>
                                    <th>{{ __("Quantity Available") }}</th>
                                    <th>{{ __("Type") }}</th>
                                    <th>{{ __("Options") }}</th>
                    
                                    </tr>
                                    </thead>
                            </tr>
                            @foreach($products_category as $product)  
                                <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }} {{ __("EGP")}}</td>
                                <td>{{ $product->categories->cat_name }}</td>
                                <td>{!! get_status($product->active) !!}</td>
                                <td>
                                  @if($product->barcode)
                                  <img
                                    id="barcode-{{$product->id}}"
                                    jsbarcode-value="{{$product->barcode}}"
                                    jsbarcode-textmargin="0"
                                    jsbarcode-height="30"
                                    jsbarcode-width="1"
                                    jsbarcode-background="#F9F9F9"
                                    jsbarcode-flat="true"
                                    jsbarcode-textAlign="center"
                                    jsbarcode-fontoptions="normal" />
                                  
                                  <script>JsBarcode("#barcode-{{$product->id}}").init();</script>
                                  @else
                                  <p>no barcode assigned</p>
                                  @endif
                                </td>
                                <td>{{ number_format($product->average_price(), 2, '.', ',') }}</td>
                              <td>{{ $product->quantity_available() }}</td>
                              <td>
                                @if($product->HasType('service'))
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                                @else
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                @endif
                              </td>
                                <td>
                          
                                    <form style="display:inline;" id='toggle-{{$product->id}}' action="{{ route('product.toggleState') }}" method="post">
                                      @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">  
                                      <button type='submit' class="btn btn-success btn-xs" data-toggle='tooltip' title='Activate/Deactivate'>
                                        @if($product->active)
                                        <i class="fa fa-remove" aria-hidden="true"></i> {{__("Deactivate")}}
                                        @else
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> {{__("Activate")}}
                                        @endif
                                      </button>
                                    </form>
                                    
              
                                     
                                  <a href="#" id='edit-{{$product->id}}' class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> {{__("Edit")}}</a>
                                  <script>
                                  $('#edit-{{$product->id}}').on('click', function(){
                                    $('#myModal-{{$product->id}}').modal('show');
                                  });
                                  $( '#EditProductForm-{{ $product->id }}' ).on( 'submit', function(e) {
                                    e.preventDefault();
                                    $('#myModal-{{$product->id}}').modal('hide');  
                                    var id = $(this).find('input[name=id]').val();
                                    var name = $(this).find('input[name=product_name]').val();
                                    var price = $(this).find('input[name=product_price]').val();
                                    var theType = $(this).find('select[name=product_type]').val();
                                    var category = $(this).find('select[name=product_category]').val();
                                    $.ajax({
                                        type: "POST",
                                        url: '{{ route("products.edit")}}',
                                        data: { 
                                            "name": name,
                                            "id": id,
                                            "price": price,
                                            "product_type": theType,
                                            "category": category,
                                            "_token": "{{ csrf_token() }}"
                                            }, 
                                        success: function( msg ) {
                                            loadContent();
                                            toast("{{__('Success')}}","{{ __('Product Was Updated Successfully') }}","green","fa fa-check",true,'topLeft');

                                            console.log(msg);
                                        }
                                    });

                                });
                                $( '#toggle-{{ $product->id }}' ).on( 'submit', function(e) {
                                    e.preventDefault();
                                    var id = $(this).find('input[name=id]').val();
                                    $.ajax({
                                        type: "POST",
                                        url: '{{ route("product.toggleState")}}',
                                        data: { 
                                            "id": id,
                                            "_token": "{{ csrf_token() }}"
                                            }, 
                                        success: function( msg ) {
                                            loadContent();
                                            toast("{{__('Success')}}","{{ __('Product Was Updated Successfully') }}","green","fa fa-check",true,'topLeft');

                                            console.log(msg);
                                        }
                                    });

                                });
                                $( '#delete-{{ $product->id }}' ).on( 'submit', function(e) {
                                    e.preventDefault();
                                    var id = $(this).find('input[name=id]').val();
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
                                        url: '{{ route("products.delete")}}',
                                        data: { 
                                            "id": id,
                                            "_token": "{{ csrf_token() }}"
                                            }, 
                                        success: function( msg ) {
                                            loadContent();
                                            console.log(msg);
                                        }
                                    });
                                        swal(
                                          'Deleted!',
                                          'Your file has been deleted.',
                                          'success'
                                        )
                                      }
                                    })
                                    

                                });
                                </script>

                                  <div class="modal fade" id="myModal-{{ $product->id }}" tabindex="-1" role="dialog">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Update {{$product->name}}</h4>
                                      </div>
                                    <form action="{{ Route('products.edit') }}"  id='EditProductForm-{{ $product->id }}' method="post">
                                      <div class="modal-body">
                                          <div class="form-group">
                                              <label for="product_name">{{__("Product Name")}}</label>
                                              <input type="text" class="form-control" name="product_name" id="product_name" aria-describedby="helpId" value="{{ $product->name }}" placeholder="{{__("Product Name")}}">
                                                <small id="helpId" class="form-text text-muted">{{__("Product Name")}}</small>
                                      </div>        
                                      <div class="form-group">
                                          <label for="product_price">{{__("Product price")}}</label>
                                          <input type="hidden" name="id" value='{{ $product->id }}'>
                                          <input type="text" class="form-control" name="product_price" id="product_price" aria-describedby="helpId" value="{{ $product->price }}" placeholder="{{__("Product Price")}}">
                                            <small id="helpId" class="form-text text-muted">{{__("Product Price")}}</small>
                                      </div>
                                      <div class="form-group">
                                        <label for="product_type">{{__("Product Type")}}</label>
                                        <select type="text" class="form-control" name="product_type" id="product_type" aria-describedby="helpId" placeholder="{{__("Product Type")}}">
                                                <option value='product'>Product</option>
                                                <option value='service'>Service</option>
                                        </select>
                                          <small id="helpId" class="form-text text-muted">{{__("Product Type")}}</small>
                                    </div>
                                      <div class="form-group">
                                          <label for="product_category">{{__("Product Category")}}</label>
                                          <select type="text" class="form-control" name="product_category" id="product_category" aria-describedby="helpId" placeholder="{{__("Product Category")}}">
                                              @foreach($cats as $cat)
                                                  <option value='{{ $cat->id }}' 
                                                    @if($product->category_id == $cat->id) selected @endif>{{ $cat->cat_name }}</option>
                                              @endforeach
                                          </select>
                                            <small id="helpId" class="form-text text-muted">{{__("Product Category")}}</small>
                                      </div> 
                                      </div>
                                      <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                      </div>
                                    </form>
                                    </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <form action="post" style="display:inline;" id='delete-{{ $product->id }}'>
                                  <input type="hidden" name="id" value='{{ $product->id }}'>  
                                  <button type='submit' class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> {{__("Delete")}} </button>
                                </form>
                                
                                  </td>
                                </tr>
                            @endforeach
                            @endforeach
                          </tbody>
                      </table>
                        
                    </div>
                @else
                    <h3>
                    {{__("No Products Available")}}
                    </h3>
                @endif