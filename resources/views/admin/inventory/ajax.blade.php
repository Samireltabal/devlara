<h3>Latest Additions</h3>
                    <table class="table table-sm table-bordered table-inverse table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Batch Number</th>
                                <th>Product Name</th>
                                <th>Quantitny</th>
                                <th>Price</th>
                                <th>Supplier</th>
                                <th>Type</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                        <td scope="row">{{$item->id}}</td>
                                        <td>{{$item->product['name']}}</td>
                                        <td>{{$item->quantity}} item</td>
                                        <td>{{$item->price}} EGP</td>
                                        <td>@if($item->supplier)
                                            {{$item->supplier['supplier_name']}}
                                            @else
                                            {{ __('Product Return') }}
                                            @endif
                                        </td>
                                        <td>{{ $item->typeFn->name }}</td>
                                        <td>{{$item->total}} EGP</td>
                                    </tr>
                                @endforeach                            
                            </tbody>
                    </table>