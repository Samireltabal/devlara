
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>  
<span class="pull-right">
        <a href="{{ route('invoice.print',$id) }}" target="_blank" class="btn btn-default btn-lg" style="margin-top:1em;"><i class="fa fa-print" aria-hidden="true"></i> {{__("print")}}</a>
        </span>
@if($invoice)
<h3>{{__("Current Invoice")}}</h3>
@else
<h3>{{__("public sales")}}</h3>
@endif






<table class="table table-sm table-bordered table-responsive">
    <thead class="thead-default">
        <tr>
            <th>{{ __("Product Name")}}</th> 
            @if($invoice)
            <th>{{ __("SN") }}</th>
            @endif
            <th>{{ __("Quantity") }}</th>
            <th>{{ __("Price") }}</th>
            <th>{{ __("Discount") }}</th>
            <th>{{ __("Item Price") }}</th>
            <th>{{ __("Total") }}</th>
            <th>{{ __("delete") }}</th>
        </tr>
        </thead>
        <tbody>
            {{-- {{ $invoice_items_details }} --}}
            @foreach($invoice_items_details as $key => $items)
            @if($items->sum('quantity') < 0)
                <tr class='bg-danger'>
            @else
                <tr>
            @endif
                    <th scope="row">@if(get_product_name($items->product_id))
                        {{ get_product_name($items->product_id)->name }} 
                        @else
                            deleted product   
                        @endif
                    </th>
                    @if($invoice)
                    <td>
                        {{ $items->sn }}
                    </td>
                    @endif
                    <td>{{ $items->quantity }}</td>
                <td>{{ $items->price }} {{__("EGP")}}</td>
                <td>{{ $items->discount }} %</td>
                <td>{{ $items->discounted_price }} {{__("EGP")}}</td>
                <td>{{ $items->total }} {{__("EGP")}}</td>
                <td><a href="{{ route('item_delete',$items->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i> {{__("delete")}}</a></td>
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
