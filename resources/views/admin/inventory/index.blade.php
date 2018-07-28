@extends('admin.layout.app')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
@section('title')
  {{__("Inventory")}}
@endsection


@section('content')
      <div class="box">
            <div class="box-header">
              
              <h3 class="box-title">{{ __("Inventory")}}</h3>
              @if(get_locale() == "ar")
              <?php $dir = "pull-left"; ?>  
              @else
              <?php $dir = "pull-right"; ?>  
              @endif
              
              <span class='{{ $dir }}'><strong>{{ __("Date") }} : {{ $time::today()->format('Y-m-d') }}</strong></span></td>
              <br>
              <span class='{{ $dir }}'><a id='addReturn' class='btn btn-success btn-sm btn-flat'><i class="fa fa-plus-square-o" aria-hidden="true"></i> {{ __("Create Return") }}</a></span>

               
                <div class="clearfix"></div>
                
            </div>
            <div class="return" id="returndiv" style='display:none;'>
                @include('admin.inventory.Returnform')
            </div>
            <div id='boxBody' class="box-body clearfix">
                <h3 class="box-title">{{ __("Add Inventory")}}</h3>
                @include('admin.inventory.form')
            </div>
            <div id='inventoryStuff' class="box-footer clearfix">
                    @include('admin.inventory.ajax')
            </div>
        </div>
        <script>
          $(document).ready( function() {
            var btn = document.getElementById('addReturn');
            $(btn).click(function(){
              $('#returndiv').toggle('highlight',400);
            });
          })
          
                          
        </script>
@endsection