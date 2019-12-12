@extends('print.layout')
@section('type')a5 @endsection
@section('data')
<style>
.tableText { font-size: 0.8em; }
</style>
<table class="table table-sm table-bordered table-responsive ">
    <thead class="thead-default">
        <tr>
            <th>{{ __("Product Name")}}</th> 
            @if($invoice)
            <th class='hidden'>{{ __("SN") }}</th>
            @endif
            <th>{{ __("Quantity") }}</th>
            <th>{{ __("Price") }}</th>
            <th> {{ __("Discount")}} </th>
            <th> {{ __("Final Price")}} </th>
            <th>{{ __("Total") }}</th>
        </tr>
        </thead>
        <tbody class='tableText'>
            @foreach($invoice_items as $items) 
            <tr>                
                <th scope="row" class='product_name'>
                    @if(get_product_name($items->product_id))
                        {{ get_product_name($items->product_id)->name }} 
                    @else
                        deleted product   
                    @endif
                </th>
                @if($invoice)
                    <td class='hidden'>
                        <span>{{ $items->sn }}</span>
                    </td>                    
                @endif    
                <td>{{ $items->quantity }}</td>
                <td>{{ $items->price }}</td>
                <td>{{ $items->discount }} </td>
                <td>{{ $items->discounted_price }} {{__("EGP")}}</td>
                <td>{{ $items->total }} {{__("EGP")}}</td>
                </tr>
            @endforeach
            
        </tbody> 
        <tfoot>
            <tr>
                @if($invoice)
                    <th colspan="5">{{__("Total")}} : </th>
                    <td colspan="2">{{ $sum_invoice }} {{__("EGP")}}</td>
                @else
                    <th colspan="5">{{__("Total")}} : </th>
                    <td colspan="2">{{ $sum_invoice }} {{__("EGP")}}</td>
                @endif
            </tr>            
        </tfoot>
</table>


@endsection