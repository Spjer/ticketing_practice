@extends('layout.master')
 
@section('title', 'Comments')
 
@yield('navbar')

@section('content')
<main>
@if(count($ticket->comments))

<table class="table" border=1>
                <thead>
                  <tr>
                    <th scope="col">Id ticketa</th>
                    <th scope="col"> Id komentara</th>
                    <th scope="col"> Komentar</th>
                    <th scope="col"> Datum</th>
                    <th scope="col"> </th>
                  </tr>
                </thead>
                
                <tbody>
                  @foreach($ticket->comments as $comment) 
                    <tr align="right">
                      <td>{{$ticket->id}}</td>
                      <td>{{$comment->id}}</td>
                      <td>{{$comment->comm}}</td>
                      <td>{{$comment->created_at}}</td>
                      <td>
                       <!-- delete comment -->
                        <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
                        @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Izbriši komentar</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
@else
  <p>Nema komentara</p>
@endif
</main>
@stop