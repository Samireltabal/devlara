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

                    <div class="col-lg-6">
                        <h3>{{__("Statistics")}}</h3>
                        <canvas id="pieChart" style="height:250px"></canvas>
                    </div>
                    <div class="col-lg-6">
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
                                            <td>{{ $shift->sales()->sum('total') }} {{__("EGP")}}</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>{{ __("Total Expenses") }}</th>
                                            <td>{{ $shift->expenses()->sum('expense_sum') }} {{__("EGP")}}</td>
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
        </div>
        
      <script>
      //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : {{$shift->sales()->sum('total')}},
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : '{{__("income")}}'
      },
      {
        value    : {{$shift->expenses()->sum('expense_sum')}},
        color    : '#f56954',
        highlight: '#f56954',
        label    : '{{__("expenses")}}'
      },
      {
        value    : '{{ $shift->sales()->sum('total') - $shift->expenses()->sum('expense_sum') }}',
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : '{{__("net")}}'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 50,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Pie(PieData, pieOptions)

</script>
@endforeach
@endsection