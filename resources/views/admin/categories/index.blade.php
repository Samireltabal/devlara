@extends('admin.layout.app')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
@section('title')
  {{__("Categories")}}
@endsection


@section('content')
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __("Suppliers")}}</h3>
              @if(get_locale() == "ar")
              <?php $dir = "pull-left"; ?>  
              @else
              <?php $dir = "pull-right"; ?>  
              @endif
              
              <span class='{{ $dir }}'><strong>{{ __("Date") }} : {{ $time::today()->format('Y-m-d') }}</strong></span></td>
              <br>
            <span class='{{ $dir }}'><a id='addCategory' class='btn btn-success btn-sm btn-flat'><i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ __("Add Category") }}</a></span>
               
                </tr>
            </div>  
            <div id='boxBody' class="box-body clearfix">
                
            </div>
          <div id='catForm' class="box-footer clearfix" style="display:none;">
          <form action="{{ route("categories.create")}}" id='TheCatForm' method="post">

            <div class="form-group">
                    <label for="category_name">{{__("Category Name")}}</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="helpId" placeholder="{{__("Category Name")}}">
                      <small id="helpId" class="form-text text-muted">{{__("Category Name")}}</small>
            </div>        
            <div class="form-group">
                        @csrf
                        <button type="submit" class='btn btn-success btn-block'>
                            {{__("Add Category")}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script>
        $(document).ready( function(){
            loadContent();
            $( '#TheCatForm' ).on( 'submit', function(e) {
                e.preventDefault();
                var name = $(this).find('input[name=category_name]').val();
                $.ajax({
                    type: "POST",
                    url: '{{ route("categories.create")}}',
                    data: { 
                        "category_name": name,
                        "_token": "{{ csrf_token() }}"
                        }, 
                    success: function( msg ) {
                        loadContent();
                        toast("{{__('Success')}}","{{ __('Category Was Added Successfully') }}","green","fa fa-check",true,'topLeft');

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
							          url: "{{ route('categories.ajax') }}",
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