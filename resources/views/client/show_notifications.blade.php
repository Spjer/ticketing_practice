@extends('layout.masterClient')
 
@section('title', 'Notifications')
 
@yield('navbar')

@section('content')
<main>
    <div class='notif-list'>
        <!--<form action="{{route('notifications.index')}}" method="GET" role="search">
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
                <th scope="col"><a href="{{ route('notifications.index-unread') }}" title="Show unread only"><i class="fa fa-book-reader" ></th>
                

                

               
            </tr>
        </thead>
        <tbody>
        @foreach ($notifications as $notification)
        <tr  @if($notification->read_at != NULL) style="background-color: rgb(236, 233, 233); " @endif
            @if($notification->id == $notification_show->id) class="border border-success border-2 border-start-0 border-end-0" @endif>
        
            <td>@if($notification->read_at != NULL) <i class="fa-solid fa-check"></i> @endif</td>
            <td><a href="{{ route('notifications.show', [$notification->id]) }}" >{{$notification->data['title']}}</a></td>
            <td>{{$notification->created_at}}</td>
            <td>
            <a href="{{ route('notifications.destroy', [$notification->id]) }}" title="delete"><i class="fa fa-trash" ></i></a>
            </td>
        </tr>
              
        
        
        @endforeach
                
        </tbody>
  
      
    </table>
    {{$notifications->links('pagination::bootstrap-5')}}
    </div>

    <div class="notif-show">
        <p style="font-size: 12px; float: right">{{$notification_show->created_at}}<br>{{  $notification->created_at->diffForHumans()}}</p>
        <p style="font-size: 18px;">&nbsp&nbsp&nbsp&nbsp{{$notification_show->data['title']}}</p>
        <br>
        <br>
        <p>
            {{$notification_show->data['body']}}
    </div>

</main>
@stop