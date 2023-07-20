@extends('layout.master')
 
@section('title', 'Home')
 
@yield('navbar')
    

 


@section('content')
<main width = 100%>
    
    @if ( Session::has('flash_message') )

        <span class="alert alert-success alert-block" style="left: 50%">
            {{ Session::get('flash_message') }}
        </span>

    @endif

    <h1>Hello {{ Auth::user()->name }}</h1> <br>
    <!--<div class="card">
        <div class="card-body" >
            Name: {{ Auth::user()->name }} <br> <br>
            Role: {{ Auth::user()->role }} <br>
        </div>
    </div>-->
    <div class="card">
        <div class="card-header">
            <h2>My Statistics</h2>  
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm12 col-xl-6">
            
            </div>
            <div class="col-xs-12 col-md-12 col-sm12 col-xl-6">
            
            </div>
        </div>
        <div class="row" >
            <div class="col-xs-12 col-md-12 col-sm12 col-xl-6" >
                    <div class="card" id="piechart" style="width: 495px; height: 353px;"></div>
                    
              
            </div>
            <div class="col-xs-12 col-md-12 col-sm12 col-xl-6" >
                <div class="card" >
        
                    <div class="card-body">
                        <h5 class="card-title">Active tickets:</h5>
                        <p class="card-text">{{$tickets->count()}}</p>
                    </div>
                </div>
                <div class="card" >
    
                    <div class="card-body">
                        <h5 class="card-title">Open tickets:</h5>
                        <p class="card-text">{{$open}}</p>
                    </div>
                </div>
                <div class="card" >
    
                    <div class="card-body">
                        <h5 class="card-title">Tickets in progress:</h5>
                        <p class="card-text">{{$inProgress}}</p>
                    </div>
                </div>
                <div class="card" >
    
                    <div class="card-body">
                        <h5 class="card-title">Closed tickets:</h5>
                        <p class="card-text">{{$closed}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">                    
            <div class="col-xs-12 col-md-12 col-sm12 col-xl-6" >
                <div class="card" id="columnchart_material" style="width: 495px; height: 309px;"></div>
            </div>
        </div>
    </div>    
    

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Ticket', 'Status'],
            ['Open', {{$open}}],
            ['Closed', {{$closed}}],
            ['In progress', {{$inProgress}}],
            ]);

            var options = {
            //title: 'My Tickets'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
      
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart2);

        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
            ['Status', 'You', 'Average'],
            ['Active', {{$tickets->count()}}, {{$all_tickets}}],
            ['Open', {{$open}}, {{$all_open}}],
            ['In Progress', {{$inProgress}}, {{$all_inProgress}}],
            ['Closed', {{$closed}}, {{$all_closed}}]
            ]);

            var options = {
            chart: {
                title: 'Your Performance',
                subtitle: 'Ticket status compared to average',
            }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

   
</main>




@stop