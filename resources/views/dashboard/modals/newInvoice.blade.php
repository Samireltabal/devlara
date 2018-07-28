<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                    <h4 class="modal-title" id="invoiceModal">Create New Invoice</h4>
                </div>
            <form action="{{ route("sales.createInvoice") }}" method="post">
                <div id='modalBody' class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                        <label for="customer_name">{{ __("Name :") }}</label>
                          <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name" aria-describedby="helpId">
                          <small id="helpId" class="text-muted">{{__("Auto Complete")}}</small>
                        </div>
                        @csrf
                        {{-- <input type="hidden" name="customer_id"> --}}
                        <div class="form-group">
                                <label for="customer_phone">{{ __("Name :") }}</label>
                                  <input type="phone" name="customer_phone" id="customer_phone" class="form-control" placeholder="Customer Phone" aria-describedby="helpId">
                                  <small id="helpId" class="text-muted">{{__("Write Down the Phone if new")}}</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">    
                    <button type="submit" class="btn btn-success btn-lg btn-block">Save</button>
                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"><i class="fa fa-remove" aria-hidden="true"></i> Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function()
            {
                $( "#customer_name" ).autocomplete({
                source: '{{route("customers.ac")}}',
                minLength: 3,
                appendTo : $("#modalBody"),
                select: function(event, ui) {
                    $('#customer_name').val(ui.item.value);
                    $('#customer_phone').val(ui.item.phone);
                }
                });
            });
    </script>