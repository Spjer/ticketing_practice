@extends('layout.master')
 
@section('title', 'My tickets')
 
@yield('navbar')

@section('content')
<main>

    <div class='notif-list'>
        <!--<form action="#" method="GET" role="search">
        @csrf
            <div class="input-group">
                <input type="text" class="form-control" name="title"
                    placeholder="Search notifications" default=" "> <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    </span>
                </input>
            </div>
        </form>-->
    <table class="table"   style="width: 100%">
        <thead>
            <tr>
            <th scope="col"></th>
                <th scope="col">Title</th>
                <th scope="col">Created_at</th>
                <th scope="col"><a href="{{ route('notifications.index-unread') }}" title="Show unread only"><i class="fa fa-book-reader" ></a></th>
                
            </tr>
        </thead>
        <tbody>
        @foreach ($notifications as $notification)
        <tr @if($notification->read_at != NULL) style="background-color: rgb(236, 233, 233); " @endif>
        <td>@if($notification->read_at != NULL) <i class="fa-solid fa-check"></i> @endif</td>
            <td><a href="{{ route('notifications.show', [$notification->id]) }}" >{{$notification->data['title']}}</a></td>
            <td>{{$notification->created_at}}</td>
            <td>
                <a href="{{ route('notifications.destroy', [$notification->id]) }}" title="Delete"><i class="fa fa-trash" ></i></a>
            </td>
        </tr>
              
        
        
        @endforeach
                
        </tbody>
  
      
    </table>
   
    {{$notifications->links('pagination::bootstrap-5')}}

    </div>
</main>
@stop