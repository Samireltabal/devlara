@extends('print.layout')
@section('type')a5 @endsection
@section('data')

<table class="table table-sm table-bordered table-responsive">
    <thead class="thead-default">
        <tr>
            <th>{{ __("Product Name")}}</th> 
            @if($invoice)
            <th>{{ __("SN") }}</th>
            @endif
            <th>{{ __("Quantity") }}</th>
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
                        @if($item->quantity > 0)
                       <span>{{ $item->sn }}</span>                            <br>

                        @else
                        <span>{{ $item->sn }}</span>                            <br>

                        @endif
                            @endif
                        @endforeach
                    </td>
                    @endif
                    <td>{{ $items->sum('quantity') }}</td>
                <td>{{ $items->avg('discounted_price') }} {{__("EGP")}}</td>
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


@endsection