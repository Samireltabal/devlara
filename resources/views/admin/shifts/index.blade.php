@extends('admin.layout.app')
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
@section('title')
  {{__("Shifts")}}
@endsection


@section('content')
    @foreach($shifts as $shift)
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __("Shifts")}}</h3>
              @if(get_locale() == "ar")
              <?php $dir = "pull-left"; ?>  
              @else
              <?php $dir = "pull-right"; ?>  
              @endif
              <span class='{{ $dir }}'><strong>{{ __("Date") }} : {{ $time }}</strong></span></td>
                </tr>
            </div>  
            <div class="box-body clearfix">
                @if($shifts->count())

                    
                    <div class="col-lg-12">
                        <h3>{{__("Shift Data")}}</h3>
                        <table class="table table-sm table-bordered table-responsive">
                                <tbody>
                                    <tr>
                                        <th scope="row">{{__("Shift Date")}}</td>
                                        <td>{{ $shift->created_at }}</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">{{__("Shift Status")}}</td>
                                    <td>
                                        <span class='label label-success'>{{__("Active")}}</span>
                                    </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{__("Opened By")}}</td>
                                        <td>
                                            {{ $shift->user->name}}
                                        </td>
                                        </tr>                                    
                                    <tr>
                                        <th scope='row'>{{ __("Employees") }}</th>
                                        <td>{{ $shift->attendances()->count() }}</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>{{ __("Invoices") }}</th>
                                            <td>{{ $shift->invoices()->count() }}</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>{{ __("Total Sales") }}</th>
                                            <td>{{ $shift->sales_total() }} {{__("EGP")}}</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>{{ __("Total Services Sales") }}</th>
                                            <td>{{ $shift->service_total() }} {{__("EGP")}}</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>{{ __("Total Expenses") }}</th>
                                            <td>{{ $shift->expenses()->sum('expense_sum') }} {{__("EGP")}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{__("Salaries Paid")}}</th>
                                        <td> {{ $shift->salaries()->sum('paid') }}</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">{{__("Inventory Purchased")}}</th>
                                        <td>{{ $shift->total_paid() }} {{ __("EGP")}}</td>
                                        </tr>
                                        <tr>
                                                <th scope="row">{{__("Returns")}}</th>
                                                <td>{{ $shift->total_returns() }} {{ __("EGP")}}</td>
                                                </tr>
                                        <tr>
                                            <th scope='row'>{{ __("Available Cash") }}</th>
                                            <td>{{ $shift->sales()->sum('total') - $shift->expenses()->sum('expense_sum') - $shift->total_returns() }} {{__("EGP")}}</td>
                                        </tr>
                                    @if($time !== $shift->created_at)
                                    <tr>
                                    <th scope='row' colspan="2"><span class='label label-danger expanded'>{{__("You have to Create new shift")}}</span></th>
                                    </tr>
                                    @endif
                                </tbody>
                        </table>
                    </div>
                @else
                    <h3>
                    {{__("No Shifts Available")}}
                    </h3>
                @endif
            </div>
          
        </div>
     
@endforeach
<div class="box-footer clearfix">
    <form action="{{ route("shifts.create")}}" method="post">
              <div class="form-group">
                  @csrf
                  <button type="submit" class='btn btn-success btn-block'>
                      {{__("New Shift")}}
                  </button>
              </div>
          </form>
      </div>
      @endsection
 