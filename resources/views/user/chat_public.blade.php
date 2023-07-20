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
                    <h1>Let's Talk</h1>
                </header>
                <div id="messages" class="card" style=" height:500px; display:flex;">        
                </div>

                <form id="message_form" >
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