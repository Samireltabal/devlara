@extends('dashboard.layout')
@section('content')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
    <div class="row appUI">
        <div class='container-fluid pos'>
        <div class='col-lg-4'>
                <div class='col-lg-12 panel'>
                    @include('dashboard.buttons')
                </div>
                <div class="col-lg-12 panel">
                    @include('dashboard.expenses')
                </div>
        </div>
        
        <div class="col-md-8">
            <div class='col-lg-12 panel'>
                @include('dashboard.form')
            </div>
        </div>
        <div class='col-lg-12'>
                <div class='col-lg-12 panel' id="invoice">        
                </div>
        </div>
        </div>
    </div>
    <script>
    $(document).ready( function() {
        loadContent('{{ $current_invoice["id"] }}')
    })
    </script>
    <script>
        function loadContent(id) {
            var uri = "{{ route('sales.invoice.ajax','') }}/" + id;
                    $.ajax({
                                              type: 'GET',
                                              url: uri,
                                              dataType: 'html',
                                              cache: false,
                                              success: function(result){
                                                $("#invoice").html(result);
                                              },
                                            });	
                };
        </script>
@endsection
