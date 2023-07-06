@extends('layout.master')
 
@section('title', 'My tickets')
 
@yield('navbar')

@section('content')
<main>
    <div class='notif-list'>
    <table class="table"   style="width: 555px">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Created_at</th>
                <th scope="col">hmm</th>
                

             
               
            </tr>
        </thead>
        <tbody>
        @foreach ($notifications as $notification)
        <tr @if($notification->read_at != NULL) style="background-color: rgb(236, 233, 233); " @endif>
            <td><a href="{{ route('notifications.show', [$notification->id]) }}" >{{$notification->data['title']}}</a></td>
            <td>{{$notification->created_at}}</td>
            <td>
                <i class="fa fa-book-reader" ></i>&nbsp<a href="{{ route('notifications.destroy', [$notification->id]) }}" ><i class="fa fa-trash" ></i></a>
            </td>
        </tr>
              
        
        
        @endforeach
                
        </tbody>
  
      
    </table>
    </div>
</main>
@stop