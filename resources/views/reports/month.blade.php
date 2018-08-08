@extends('admin.layout.app')

@section('content')
<div class="col-lg-12">
<h5>Time Now : {{ carbon\Carbon::now() }}</h5>
</div>
<div class="col-lg-6">
    <h3>Last Month Stats</h3>
    <canvas id="income"></canvas>
</div>
<div class="col-lg-6">
        <h3>Today</h3>
    <canvas id="pie"></canvas>
</div>
<div class="col-lg-3">
    Empty
</div>
<div class="col-lg-9">
    <h3>Testers</h3>
        today
        <h4>{{ carbon\Carbon::now() }}</h4>
        Last Month
        <h4>{{ carbon\Carbon::now()->subDays(30) }}</h4>
</div>
<script>
        var labels = [], sales = [], services = [], expenses = [], salaries = [], inventories = [];
        var jsonData = $.ajax({
        url: "{{ route('reports.monthly.json') }}",
        dataType: 'json',
        success: function(rtnData) {
        $.each(rtnData.data, function(dataType, data) {
            sales.push(data.sales);
            services.push(data.services);
            expenses.push(data.expenses);
            salaries.push(data.salaries);
            inventories.push(data.inventoriesPurchased)
                labels.push(data.shift_date);                
                var ctx = document.getElementById("income");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Sales',
            data: sales,
            backgroundColor: 'rgba(241, 196, 15,0.2)',
            borderColor: 'rgba(241, 196, 15,1.0)',
            borderWidth: 1
        },
        {
            label: 'Services',
            data: services,
            backgroundColor: 'rgba(192, 57, 43,0.2)',
            borderColor: 'rgba(192, 57, 43,1.0)',
            borderWidth: 1
        },
        {
            label: 'Expenses',
            data: expenses,
            backgroundColor: 'rgba(46, 204, 113,0.2)',
            borderColor: 'rgba(46, 204, 113,1)',
            borderWidth: 1
        },
        {
            label: 'Salaries',
            data: salaries,
            backgroundColor: 'rgba(41, 128, 185,0.2)',
            borderColor: 'rgba(41, 128, 185,1.0)',
            borderWidth: 1
        },
        {
            label: 'Inventories',
            data: inventories,
            backgroundColor: 'rgba(142, 68, 173,0.2)',
            borderColor: 'rgba(142, 68, 173,1.0)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                stacked: false
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
        url:"{{ route('reports.monthly.json') }}",
        dataType:'json',
        success: function(rtnData) {
            console.log(rtnData.pie);
            for (var property in rtnData.pie) {
                if ( ! rtnData.pie.hasOwnProperty(property)) {
                    continue;
                }
                pie_labels.push(property);
                pie_data.push(rtnData.pie[property]);
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