@extends('admin.layout.app')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
@section('title')
  {{__("Suppliers")}}
@endsection


@section('content')
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __("Suppliers")}}</h3>
              @if(get_locale() == "ar")
              <?php $dir = "pull-left"; ?>  
              @else
              <?php $dir = "pull-right"; ?>  
              @endif
              <span class='{{ $dir }}'><strong>{{ __("Date") }} : {{ $time::today()->format('Y-m-d') }}</strong></span></td>
                </tr>
            </div>  
            <div class="box-body clearfix">
                @if($suppliers->count())

                    <div class="col-lg-12">
                      
                      <table class="table table-striped table-sm table-bordered table-hover table-responsive">
                        <thead class="thead-default">
                          <tr>
                            <th>{{__("ID")}}</th>
                            <th>{{__("Name")}}</th>
                            <th>{{__("Phone")}}</th>
                            <th>{{__("Address")}}</th>
                            <th>{{__("Total Actions")}}</th>
                            <th>{{__("Total Payments")}}</th>
                            <th>{{__("Return Actions")}}</th>
                            <th>{{__("Total Returns")}}</th>

                          </tr>
                          </thead>
                          <tbody>
                            @foreach($suppliers as $supplier)
                            <tr>
                              <th class='table-inverse'>{{$supplier->id}}</th>
                              <td scope="row">{{$supplier->supplier_name}}</td>
                              <td>{{$supplier->phone}}</td>
                              <td>{{$supplier->address}}</td>
                              <td>{{ $supplier->inventories()->count() }}</td>
                            <td>
                              {{ $supplier->total_paid() }} {{ __("EGP")}}
                            </td>
                            <td>
                                {{ $supplier->returns_count() }}
                              </td>
                              <td>
                                  {{ $supplier->returns() }} {{ __("EGP")}}
                                </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                        
                    </div>
                @else
                    <h3>
                    {{__("No Suppliers Available")}}
                    </h3>
                @endif
            </div>
          <div class="box-footer clearfix">
          <form action="{{ route("suppliers.create")}}" method="post">

            <div class="form-group">
                    <label for="supplier_name">{{__("Supplier Name")}}</label>
                    <input type="text" class="form-control" name="supplier_name" id="supplier_name" aria-describedby="helpId" placeholder="{{__("Supplier Name")}}">
                      <small id="helpId" class="form-text text-muted">{{__("Supplier Name")}}</small>
                    </div>        
                    <div class="form-group">
                            <label for="supplier_address">{{__("Supplier Address")}}</label>
                            <input type="text" class="form-control" name="supplier_address" id="supplier_address" aria-describedby="helpId" placeholder="{{__("Supplier Address")}}">
                              <small id="helpId" class="form-text text-muted">{{__("Supplier Address")}}</small>
                            </div>
                            <div class="form-group">
                                    <label for="supplier_phone">{{__("Supplier Phone")}}</label>
                                    <input type="text" class="form-control" name="supplier_phone" id="supplier_phone" aria-describedby="helpId" placeholder="{{__("Supplier Phone")}}">
                                      <small id="helpId" class="form-text text-muted">{{__("Supplier Phone")}}</small>
                                    </div>
            <div class="form-group">
                        @csrf
                        <button type="submit" class='btn btn-success btn-block'>
                            {{__("Add Supplier")}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
@endsection