@if($invoice)
<h3>Current Invoice</h3>
@else
<h3>public sales</h3>
@endif






<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>  

<table class="table table-sm table-bordered table-responsive">
    <thead class="thead-default">
        <tr>
            <th>{{ __("Product Name")}}</th> 
            @if($invoice)
            <th>{{ __("SN") }}</th>
            @endif
            <th>{{ __("Today Sales") }}</th>
            <th>{{ __("Price") }}</th>
            <th>{{ __("Total") }}</th>
        </tr>
        </thead>
        <tbody>
            @foreach($invoice_items as $key => $items)
            @if($items->sum('quantity') < 0)
                <tr class='bg-danger'>
            @else
                <tr>
            @endif
                    <th scope="row">@if(get_product_name($key))
                        {{ get_product_name($key)->name }} 
                        @else
                            deleted product   
                        @endif
                    </th>
                    @if($invoice)
                    <td>
                        @foreach($items as $item)
                            @if($item->sn)
                    <h4>
                        @if($item->quantity > 0)
                        {{ __("SN") }} : <span class='label label-primary'>{{ $item->sn }}</span>
                        @else
                        {{ __("SN") }} : <span class='label label-danger'>{{ $item->sn }}</span>
                        @endif

                    </h4>
                            @endif
                        @endforeach
                    </td>
                    @endif
                    <td>{{ $items->sum('quantity') }}</td>
                <td>{{ $items->avg('price') }} {{__("EGP")}}</td>
                <td>{{ $items->sum('total') }} {{__("EGP")}}</td>
                </tr>
            @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                @if($invoice)
                    <th colspan="4">{{__("Total")}} : </th>
                    <td colspan="1">{{ $sum_invoice }} {{__("EGP")}}</td>
                @else
                    <th colspan="3">{{__("Total")}} : </th>
                    <td colspan="1">{{ $sum_invoice }} {{__("EGP")}}</td>
                @endif
            </tr>
        </tfoot>
</table>
