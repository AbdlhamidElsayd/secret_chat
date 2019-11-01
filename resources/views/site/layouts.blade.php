<!DOCTYPE html>
<html>    
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>chat</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        
        <link rel="stylesheet" href="{{ asset('dest/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('dest/css/app.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
    <?php
      $user=auth()->id();
      $u=\App\User::find($user);
    ?>
    <nav class="navbar navbar-expand-lg  ">
        <a href="{{ route('home') }}" class="navbar-brand green" href="#"><h2 class="logo"><span class="letter">s</span>chat</h2></a>
        <button class="navbar-toggler  btn-success" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-material-icons"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
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
                    <a class="nav-link white" href="">The nearest</a>
                </li>
               
                @if(auth()->check())
                    <li class="nav-item  dropdown">
                        <div  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a class="nav-link white word" href="#">{{ Auth::user()->name }} <img class=" image_user" src="{{ route('image_show', Auth::user()->image) }}" alt="hello img"> </a>
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
        @yield('content')
        <script>
                function showImage(src,target) {
                    var fr=new FileReader();
                    fr.onload = function(e) { target.src = this.result; };
                    src.addEventListener("change",function() {
                        fr.readAsDataURL(src.files[0]);
                    });
                }

                var src = document.getElementById("input_id");
                var target = document.getElementById("image");
                showImage(src,target);

                var sr = document.getElementById("sr");
                var targe = document.getElementById("targe");
                showImage(sr,targe);
            </script>
            <script>
            window.Laravel = {!! json_encode([
                    'user' => auth()->check() ? auth()->user()->id : null,
                ]) !!};
            </script>
            <script src="{{ asset('js/app.js') }}"></script>
            @yield('js')
    </body>
</html>