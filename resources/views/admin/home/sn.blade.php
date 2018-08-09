@if($item->count() > 0)
<table class="table table-bordered table-inverse  table-responsive">
        <tbody>
        @foreach($item as $item)
        <tr>
            <th>#SN</th>
            <td>{{$item->sn}}</td>
        </tr>
        @if($item->quantity > 0)
        <tr class='bg-success'>
            <th>Purchased :</th>
            <td>{{ $item->created_at->diffForHumans() }}</td>
        </tr>
        <tr>
                <th>Product Name :</th>
                <td>{{ $item->product->name }}</td>
            </tr>
        @else
        <tr class='bg-danger'>
                <th>Returned :</th>
                <td>{{ $item->created_at->diffForHumans() }}</td>
        </tr>
        @endif
        <tr>
            <th>Customer Name :</th>
            <td>{{ $item->invoice->customer->name }}</td>
        </tr>
        @endforeach
        </tbody>
</table>
@else
No Data
@endif
<a id='CloseSnCheck' class='btn btn-danger btn-sm'><i class="fa fa-remove" aria-hidden="true"></i> Close</a>
<script>
    $('#CloseSnCheck').on('click', function(event){
         event.preventDefault();
         $("#snInquiry").hide('highlight',400);
     })
</script>