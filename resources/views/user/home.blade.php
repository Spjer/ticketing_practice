@extends('layout.master')
 
@section('title', 'Home')
 
@yield('navbar')
    

 


@section('content')
<main>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Open', {{$open}}],
          ['In progress', {{$inProgress}}],
          ['Closed', {{$closed}}]
        ]);

        var options = {
          //title: 'My Tickets'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    @if ( Session::has('flash_message') )

        <span class="alert alert-success alert-block" style="left: 50%">
            {{ Session::get('flash_message') }}
        </span>

    @endif

    <h1>Hello User</h1> <br>
    <div class="card">
        <div class="card-body" >
            Name: {{ Auth::user()->name }} <br> <br>
            Role: {{ Auth::user()->role }} <br>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div class="card" >
        
                    <div class="card-body">
                        <h5 class="card-title">Active tickets:</h5>
                        <p class="card-text">{{$tickets->count()}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card" >
    
                    <div class="card-body">
                        <h5 class="card-title">Open tickets:</h5>
                        <p class="card-text">{{$open}}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" >
    
                    <div class="card-body">
                        <h5 class="card-title">Tickets in progress:</h5>
                        <p class="card-text">{{$inProgress}}</p>
                    </div>
                </div>
             
            </div>
            <div class="col">
                <div class="card" >
    
                    <div class="card-body">
                        <h5 class="card-title">Closed tickets:</h5>
                        <p class="card-text">{{$closed}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    
            
   
</main>




@stop