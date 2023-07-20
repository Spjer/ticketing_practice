@extends('layout.masterClient')
 
@section('title', 'Home')
 
@yield('navbar')

@section('content')

@if ( Session::has('flash_message') )

        <span class="alert alert-success alert-block" style="left: 50%">
            {{ Session::get('flash_message') }}
        </span>

@endif

<h1>Hello {{Auth::user()->name}}</h1>
<br> <br> <br> <br>
<div class="card">
    <br>
    <div class="row justify-content-md-center">
        <div class="col-xs-12 col-md-12 col-sm12 col-xl-6 justify-content-md-center" style="text-align:center">
            <a href="{{ route('ticket-clients.show', [Auth::user()->id]) }}">
                <button type="button" class="btn btn-secondary btn-lg"> Ticket List</button>
            </a>
        </div>
        <div class="col-xs-12 col-md-12 col-sm12 col-xl-6 justify-content-md-center" style="text-align:center">
            
            <a href="{{ route('ticket-clients.create', [Auth::user()->id]) }}">
                <button type="button" class="btn btn-danger btn-lg"> Submit a Ticket</button>
            </a>    
              
        </div>
        
    </div>
    <br>
    <div class="row justify-content-md-center">
        <div class="col-xs-12 col-md-12 col-sm12 col-xl-6 justify-content-md-center">
            <div class="card" id="piechart" style="width: 495px; height: 353px;"></div>
        </div>

        <div class="col-xs-12 col-md-12 col-sm12 col-xl-6 justify-content-md-center">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">Active tickets:</h5>
                    <p class="card-text">{{$open+$inProgress+$closed}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Open tickets:</h5>
                    <p class="card-text">{{$open}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tickets in progress:</h5>
                    <p class="card-text">{{$inProgress}}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Closed tickets:</h5>
                    <p class="card-text">{{$closed}}</p>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Tickets', 'Status'],
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
      
    </script>




@stop