@extends('layout.master')
 
@section('title', 'Public chat')
 
@yield('navbar')

@section('content')
<main>
    <div class="row">
        <div class="col-4" style="width: 25%; min-width:190px; border: 1px solid #d4d4d4; border-radius:5px" >
            <table class="table" style="overflow-y:auto">
                <thead>
                    <tr>
                        <th>
                            Contacts
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <a href="{{ route('chats.index') }}">Public</a>
                        </th>
                    </tr>
                    @foreach($users as $user)
                    <tr style="height: 20px;">
                        <th><a href="{{ route('chats.show', [$user->id]) }}">{{$user->name}}</a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col">
         
            <div class="chat-area" >
                <header>
                    <h1>''''''''</h1>
                </header>
                <div id="private-messages" class="card" >
                    <div class="private-messages">
                        <div class="priv-msgs-content">
                            @foreach($messages as $message)
                                <br><br>
                                @if($message->sender_id == Auth::user()->id)
                                
                                <span class="message2" style="float: right; background-color: rgba(207, 238, 224, 0.822)">
                                    {{$message->body}} <strong>:{{$message->username}}</strong>
                                </span>
                                @else
                                
                                <span class="message2">
                                    <strong>{{$message->username}}:</strong> {{$message->body}}
                                </span>
                                @endif
                                <!--<span class="message2" @if($message->username == Auth::user()->name) style="float: right" @endif >
                                    <strong>{{$message->username}}:</strong> {{$message->body}}
                                </span>-->
                            @endforeach
                        </div>       
                    </div> 
                </div>

                <form id="message_form2" >
                    @csrf
                    <input type="hidden" name="reciever_id" id="reciever_id" value="{{$reciever_id}}"/>
                    <input type="hidden" name="username" id="username" value="{{Auth::user()->name}}"/>


                    <input type="text" name="message" id="message_input" class="form-control" style="width: 24rem;" placeholder="Write a message..."/>
                    <button type="submit" id="message_send" class="btn btn-dark btn-block">Send Message</button>
                </form>
               
            </div>
           
       </div>
    </div>
    



    <script>
       
    </script>
    
</main>
@stop