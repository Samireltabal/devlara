<table class="table table-responsive">
        <tbody>    
    <tr>
                <td colspan="2">
                <form action="{{ route('sales.invoiceRedirect') }}" method="POST">
                        <label for="invoice_id">Invoices :</label>
                        @csrf
                            <select class='form-control' name="invoice_id" id="Invoices"  onchange="this.form.submit()">
                                    <option value=''>Public</option>
                                    @foreach($invoices as $invoice)
                                    <?php 
                                    if($current_invoice['id'] == $invoice->id) {
                                        $selected = 'selected';
                                    } else{
                                        $selected = null;
                                    }
                                    ?>
                                    <option value="{{$invoice->id}}" {{ $selected }}>{{$invoice->id}} - {{$invoice->customer->name}}</option>
                                    @endforeach
                            </select>
                    </form>        
                </td>
        @if($current_invoice['id'] !== 'null')
        <tr>
            <th>{{__("Created")}} :</th>
            <td> {{ $current_invoice->created_at->diffForHumans() }} </td>
        </tr>
        
            
            </tr>
            <tr>
                <th scope="row">{{__("Invoice Id")}} :</th>
                <td>{{ $current_invoice->id }}</td>
            </tr>
            <tr>
                <th scope="row">{{__("Customer Name")}} : </th>
                <td>{{$current_invoice->customer->name }}</td>
            </tr>
            @endif
            <tr>
                <td colspan="2">
                        <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#invoiceModal">New Invoice</button>
                </td>
            </tr>
        </tbody>
</table>


<!-- Modal -->
@include('dashboard.modals.newInvoice')

<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM
        
    });
</script>