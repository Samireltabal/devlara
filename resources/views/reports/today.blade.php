@extends('admin.layout.app')
@if($top_product != null)
@section('content')
<div class="col-lg-12">
<h5>Time Now : {{ carbon\Carbon::now() }}</h5>
</div>
<div class="col-lg-6">
    <h3>Hourly Based Sales</h3>
    <canvas id="income"></canvas>
</div>
<div class="col-lg-6">
        <h3>Today</h3>
    <canvas id="pie"></canvas>
</div>
<div class="col-lg-3">
    <h3>Top Product Today</h3>
    <table class="table table-striped table-sm table-bordered table-responsive">
            <tbody>
                <tr>
                    <td scope="row">Product Name</td>
                    <td>{{ get_product_name($top_product->product_id)->name }}  </td>
                    
                </tr>
                <tr>
                    <td scope="row">Sales</td>
                    <td>{{ $top_product->cnt }} Item</td>
                    
                </tr>
                <tr>
                        <td scope="row">Total Income</td>
                <td>{{ $top_product->total }} {{ __("EGP") }}</td>
                        
                    </tr>
            </tbody>
    </table>
   
</div>
<script>
        var labels = [], total_income = [], total_peices = [];
        var jsonData = $.ajax({
        url: "{{ route('reports.today.json') }}",
        dataType: 'json',
        success: function(rtnData) {
        $.each(rtnData.hourly, function(dataType, data) {
            total_income.push(data.count);
            total_peices.push(data.total_pieces);
                labels.push(data.hour);                
                var ctx = document.getElementById("income");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Actions',
            data: total_income,
            backgroundColor: 'rgba(46, 204, 113,0.6)',
            borderColor: 'rgba(44, 62, 80,0.2)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                stacked: false,
                ticks: {
                beginAtZero: true
                }
            }]
        },
        events: ['click'],
    }
});
        });
    },
    error: function(rtnData) {
        alert('error' + rtnData);
    }
        });
        // 
        
</script>
<script>
    var pie_labels= [] , pie_data = [];
    var pie_chart = $.ajax({
        url:"{{ route('reports.today.json') }}",
        dataType:'json',
        success: function(rtnData) {
            console.log(rtnData.totals);
            for (var property in rtnData.totals) {
                if ( ! rtnData.totals.hasOwnProperty(property)) {
                    continue;
                }
                pie_labels.push(property);
                pie_data.push(rtnData.totals[property]);
                }
               
                var colors = ['rgba(241, 196, 15,1.0)', 'rgba(192, 57, 43,1.0)', 'rgba(46, 204, 113,0.6)', 'rgba(41, 128, 185,1.0)','rgba(142, 68, 173,1.0)'];
//                console.log(pie_data);
                var ctx2 = document.getElementById('pie');
                var myDoughnutChart = new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: pie_data,
                            backgroundColor: colors,
                            borderColor: 'rgba(44, 62, 80,0.2)',
                        }],

                        // These labels appear in the legend and in the tooltips when hovering different arcs
                        labels: pie_labels, 
                    },
                    options: {
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
                });
        }
    })

</script>
@endsection
@else
@section('content')
<h3>No Sales Yet</h3>
@endsection
@endif