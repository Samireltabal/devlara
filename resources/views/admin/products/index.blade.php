@extends('admin.layout.app')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
@section('title')
  {{__("Products")}}
@endsection


@section('content')
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __("Products")}}</h3>
              @if(get_locale() == "ar")
              <?php $dir = "pull-left"; ?>  
              @else
              <?php $dir = "pull-right"; ?>  
              @endif
              
              <span class='{{ $dir }}'><strong>{{ __("Date") }} : {{ $time::today()->format('Y-m-d') }}</strong></span></td>
              <br>
            <span class='{{ $dir }}'><a id='addCategory' class='btn btn-success btn-sm btn-flat'><i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ __("Add Product") }}</a></span>
               
                <div class="clearfix"></div>
                <div id='catForm' class="box-footer clearfix" style="display:none;">
                    <form action="{{ route("products.create")}}" id='TheCatForm' method="post">
          
                      <div class="form-group">
                              <label for="product_name">{{__("Product Name")}}</label>
                              <input type="text" class="form-control" name="product_name" id="product_name" aria-describedby="helpId" placeholder="{{__("Product Name")}}">
                                <small id="helpId" class="form-text text-muted">{{__("Product Name")}}</small>
                      </div>        
                      <div class="form-group">
                          <label for="product_price">{{__("Product price")}}</label>
                          <input type="text" class="form-control" name="product_price" id="product_price" aria-describedby="helpId" placeholder="{{__("Product Price")}}">
                            <small id="helpId" class="form-text text-muted">{{__("Product Price")}}</small>
                      </div>
                      <div class="form-group">
                          <label for="product_category">{{__("Product Category")}}</label>
                          <select type="text" class="form-control" name="product_category" id="product_category" aria-describedby="helpId" placeholder="{{__("Product Category")}}">
                              @foreach($cats as $cat)
                                  <option value='{{ $cat->id }}'>{{ $cat->cat_name }}</option>
                              @endforeach
                          </select>
                            <small id="helpId" class="form-text text-muted">{{__("Product Category")}}</small>
                      </div>      
                      <div class="form-group">
                                  @csrf
                                  <button type="submit" class='btn btn-success btn-block'>
                                      {{__("Add Product")}}
                                  </button>
                              </div>
                          </form>
                      </div>
            </div>  
            <div id='boxBody' class="box-body clearfix">
                
            </div>
         
        </div>
        <script>
        $(document).ready( function(){
            loadContent();
            $( '#TheCatForm' ).on( 'submit', function(e) {
                e.preventDefault();
                var name = $(this).find('input[name=product_name]').val();
                var price = $(this).find('input[name=product_price]').val();
                var active = $(this).find('input[name=active]').val();
                var category = $(this).find('select[name=product_category]').val();
                $.ajax({
                    type: "POST",
                    url: '{{ route("products.create")}}',
                    data: { 
                        "product_name": name,
                        "product_price": price,
                        "active": 1,
                        "product_category": category,
                        "_token": "{{ csrf_token() }}"
                        }, 
                    success: function( msg ) {
                        loadContent();
                        toast("{{__('Success')}}","{{ __('Product Was Added Successfully') }}","green","fa fa-check",true,'topLeft');

                        console.log(msg);
                    }
                });

            });
           
            var btn = document.getElementById('addCategory');
            var div = document.getElementById('catForm');
            $(btn).click( function(e){
                e.preventDefault();
                $(div).toggle("blind",500);
            });
        });
        
        </script>

        <script>
        function loadContent() {
            $.ajax({
							          type: 'GET',
							          url: "{{ route('products.ajax') }}",
							          dataType: 'html',
							          cache: false,
							          success: function(result){
							            $("#boxBody").html(result);
							          },
							        });	
        }
        </script>
        <script>
        function deleteCat(id) {
            $.ajax({
                    type: "delete",
                    url: '{{ route("categories.delete")}}',
                    data: { 
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                        }, 
                    success: function( msg ) {
                        loadContent();
                        toast("{{__('Success')}}","{{ __('Category Was Removed Successfully') }}","green","fa fa-check",true,'topLeft');

                        console.log(msg);
                    }
                }); 
        }
        </script>
        <script>
            function editCat(id) {
                var form_id = 'EditCat-' + id ;
                var the_form = document.getElementById(form_id);
                $(the_form).toggle('highlight',500);
            }
        </script>        
@endsection