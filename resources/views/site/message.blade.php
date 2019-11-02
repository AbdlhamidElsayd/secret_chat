<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('PNotifyBrightTheme.css') }}">    
<style>



    @import url('https://fonts.googleapis.com/css?family=Work+Sans:400,600');


    .container {
        margin-top:0px;
        width: 80%;
        margin: 0 auto;
    }

    .navbar {
        
        background-color: #848484;
    }
    .white{
        color: #FFFFFF;
    }
    .letter {
        text-transform: uppercase;
        color: rgb(123, 238, 113);
        font-style: italic;
        font-size: 30px;
        font-weight: bold;
    }
    .logo {
        color: white;
    }
    .img_card{
        width:90%;
        height:74%;
        border:1px solid #eee;
        border-radius:50%;
        display: block;
        margin: 6px auto 0 auto;

    
    }
    .main{
        margin-top:100px
    }
    .name{
        margin-top:5px;
        /* text-align:right; */
    
    }
    .ml-auto{
        padding-right:100px
    }
    .zoom{
        height:180px;
        overflow:hidden
    }

    .zoom:hover{
        background-color:#848484;
        text-shadow: 0 0 3px #848484;
    }
    .image_user{
        width:25px;
        height:25px;
        border:1px solid #eee;
        border-radius:50%;
    }
    .image_user_popup{
        width:120px;
        height:125px;
        border:1px solid #eee;
        border-radius:50%;
    }






            /* width */
            ::-webkit-scrollbar {
                width: 7px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #a7a7a7;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #929292;
            }

            .user-wrapper ul {
                margin: 0;
                padding: 0;
            }

            .user-wrapper ul li {
                list-style: none;
            }

            .user-wrapper, .message-wrapper {
                border: 1px solid #dddddd;
                overflow-y: auto;
            }

            .user-wrapper {
                height: 600px;
            }

            .user {
                cursor: pointer;
                padding: 5px 0;
                position: relative;
            }

            .user:hover {
                background: #eeeeee;
            }

            .user:last-child {
                margin-bottom: 0;
            }

            .pending {
                position: absolute;
                left: 13px;
                top: 9px;
                background: #b600ff;
                margin: 0;
                border-radius: 50%;
                width: 18px;
                height: 18px;
                line-height: 18px;
                padding-left: 5px;
                color: #ffffff;
                font-size: 12px;
            }

            .media-left {
                margin: 0 10px;
            }

            .media-left img {
                width: 64px;
                border-radius: 64px;
            }

            .media-body p {
                margin: 6px 0;
            }

            .message-wrapper {
                padding: 10px;
                height: 536px;
                background: #eeeeee;
            }

            .messages .message {
                margin-bottom: 15px;
                list-style: none;
            }

            .messages .message:last-child {
                margin-bottom: 0;
            }

            .received, .sent {
                width: 45%;
                padding: 3px 10px;
                border-radius: 10px;
            }

            .received {
                background: #ffffff;
            }

            .sent {
                background: #3bebff;
                float: right;
                text-align: right;
            }

            .message p {
                margin: 5px 0;
            }

            .date {
                color: #777777;
                font-size: 12px;
            }

            .active {
                background: #eeeeee;
            }

            input[type=text] {
                width: 100%;
                padding: 12px 20px;
                margin: 15px 0 0 0;
                display: inline-block;
                border-radius: 4px;
                box-sizing: border-box;
                outline: none;
                border: 1px solid #cccccc;
            }

            input[type=text]:focus {
                border: 1px solid #aaaaaa;
            }
</style>

    <title>messages</title>
  </head>
<body>
    <?php
        $user=auth()->id();
        $u=\App\User::find($user);
    ?>
    <nav class="navbar navbar-expand-lg ">
        <a href="{{ route('home') }}" class="navbar-brand green" href="#"><h2 class="logo"><span class="letter">s</span>chat</h2></a>
        <button class="navbar-toggler  btn-success" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-material-icons"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link white"  href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">logout
                    </a>
                </li>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li class="nav-item">
                    <a class="nav-link white" href="{{ route('chat') }}">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link white" href="{{ route('nearest') }}">The nearest</a>
                </li>
                @if(auth()->check())
                <li class="nav-item  dropdown">
                    <div  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <a class="nav-link white word" href="#">{{ Auth::user()->name }} <img class=" image_user" src="{{ route('image_show', Auth::user()->image) }}" > </a>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a data-toggle="modal" data-target="#edit_details" onclick="return false;" class="dropdown-item" href="#">Edit details</a>
                        <a data-toggle="modal" data-target="#change_photo" onclick="return false;" class="dropdown-item" href="#">change photo</a>
                        <a data-toggle="modal" data-target="#change_password" onclick="return false;" class="dropdown-item" href="#">change password</a>
                    </div>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link white" href="{{ route('login') }}">log in</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link white" href="{{ route('registeruser') }}">register </a>
                </li>
                @endif
            </ul>
            <form class="form-inline" action="{{ route('search') }}" method="GET">
                <input class="form-control mr-sm-2" type="search" name="s" placeholder="Search" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

      <div id="app">
        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user-wrapper">
                            <ul class="users">
                            @foreach($chats as $chat)
                                    @php
                                        $is_starter = false;
                                        if($chat->starter_id == auth()->id()) {
                                            $is_starter = true;
                                        }
                                        if($is_starter) {
                                            $user = \App\User::where('id', $chat->user_id)->firstOrFail();
                                        } else {
                                            $user = \App\User::where('id', $chat->starter_id)->firstOrFail();
                                        }
                                        if(request()->input('id') == $chat->id) {
                                            $activeChat = \App\Chat::find($chat->id);
                                        } elseif($loop->first) {
                                            $activeChat = \App\Chat::find($chat->id);
                                        }
                                    @endphp
                                <li class="user @if(request()->input('id') == $chat->id) active @endif" data-id="{{ $chat->id }}" id="chat_{{ $chat->id }}" >
                                    <span class="pending"></span>        
                                    <div class="media">
                                        <div class="media-left">
                                            <img src="{{ $is_starter ? route('image_show', $user->image) : 'https://via.placeholder.com/150C/O https://placeholder.com/' }}" alt="" class="media-object">
                                        </div>
    
                                        <div class="media-body">
                                            <p class="name">{{ $is_starter ? $user->name : 'unknown' }}</p>
                                            <p class="email">{{ $is_starter ? $user->email : 'unknown' }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-md-8">
                        <div class="message-wrapper">
                            <ul class="messages" id="messages">
                            @if(isset($activeChat))
                                @foreach($activeChat->messages()->oldest()->get() as $message)
                                    <li class="message clearfix">
                                        <div class="{{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                                            <p>{{ $message->message }}</p>
                                            <p class="date">{{ $message->created_at }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                            </ul>
                        </div>
                        <div class="input-text">
                            <input type="text" name="message" class="submit" id="send_message">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @if(Auth::check())
        <div class="modal fade" id="edit_details" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Edit Details</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row container">
                            <form  action="{{route('change_details')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group" >
                                    <label for="exampleInputPassword1">name</label>
                                    <input name="name" type="text" class="form-control" id="exampleInputPassword1" value="{{Auth::user()->name}}">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputPassword1">Phone</label>
                                    <input name="phone" type="text" class="form-control" id="exampleInputPassword1"  value="{{$u->phone}}">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input name="email" type="email"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{Auth::user()->email}}">
                                </div>
                                <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="change_photo" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Change Your Photo</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row container">
                            <form  action="{{route('change_photo')}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <label for="input_id">
                                    <div class="form-group" >
                                        <input type="file"  name="image" id="input_id" >
                                    </div>
                                    <div class="form-group" >
                                    `   <img id="image" class=" image_user_popup" src="{{ route('image_show', Auth::user()->image) }}" alt="hello img"> 
                                    </div>
                                </label>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Edit Details</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row container">
                            <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                                {{ csrf_field() }}                                
                                <div class="form-group" >
                                    <label for="exampleInputPassword1">old Password</label>
                                    <input name="current_password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputPassword1">new Password</label>
                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group" >
                                    <label for="exampleInputPassword1">confirm Password</label>
                                    <input  name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                            
                                <div >
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


        @if (count($errors->all()))
            <div  id="error" class="alert alert-dismissable alert-danger">
                <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span  onclick="event.preventDefault();
                                            document.getElementById('error').remove();" aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    <li><strong>{!! $error !!}</strong></li>
                @endforeach
            </div>
        @endif
        @if (session()->has('success'))
            <div id="error" class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span onclick="event.preventDefault();
                                            document.getElementById('error').remove();" aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('success') !!}
                </strong>
            </div>
        @endif

        @if (session()->has('error'))
            <div id="error" class="alert alert-dismissable alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span onclick="event.preventDefault();
                                            document.getElementById('error').remove();" aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('error') !!}
                </strong>
            </div>
        @endif

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        window.Laravel = {!! json_encode([
            'user' => auth()->check() ? auth()->user()->id : null,
        ]) !!};
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>    
        $(document).ready(function () {
            var active = $('.users .active').attr('data-id');
            if(!active)  {
                $('.users .user:first').addClass('active');
            }
            function append_message (type, message, date) {
                $('#messages').append(`
                <li class="message clearfix">
                    <div class="${type == 'user'  ? 'sent' : 'received'}">
                        <p>${message}</p>
                        <p class="date">${ date ? date : '' }</p>
                    </div>
                </li>
                `);
            }
            $('.users .user').click(function () {
                $('.users .active').removeClass('active');
                $(this).addClass('active');
                var id = $(this).attr('data-id');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var action = "{{ route('get_chat_messages') }}";
                $.ajax({
                    url:  action,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {_token: CSRF_TOKEN, id: id},
                    success: function(data, status){
                        console.log(data.data)
                        $('#messages').empty();
                        var i;
                        for(i = 0 ; i < data.data.length; i++) {
                            var type = data.data[i].sender_id == "{{ Auth::id() }}" ? 'user' : 'receiver';
                            append_message(type, data.data[i].message, data.data[i].created_at);
                        }
                    }
                }); 
            });
            $('#send_message').on('keypress',function(e) {
                if(e.which == 13) {
                    var id          = $('.users .active').attr('data-id');
                    console.log(id)
                    var message     = $('#send_message').val();
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var action = "{{ route('send_message') }}";
                    $.ajax({
                        url:  action,
                        type: 'POST',
                        dataType: 'JSON',
                        data: {_token: CSRF_TOKEN, id: id, message: message},
                        success: function(data, status){
                            if(data) {
                                append_message('user', data.data.message, data.data.created_at);
                                $('#send_message').val('');
                            }
                        }
                    }); 
                }
            });
        });
    </script>
  </body>
</html>