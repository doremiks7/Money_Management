<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Staff Management </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="public/css/style.css" type="text/css" >
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ url('public/js/myscript.js') }}"></script>
    
    <style>
        body {
            font-family: 'Lato';
        }
        ul li {
            list-style: none;
        }
        a {
            text-decoration: none;
        }
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout" onload="time()">
    <nav class="navbar-inverse navbar-static-top" id="nav-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="glyphicon glyphicon-asterisk"></i>Quản lý tài chính
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if (Auth::guest())
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}"><i class="fa fa-linux"></i> Home </a></li>
                </ul>
                @else
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-phone"></i> 0961915162 </a></li>
                    <li><a href="{{ route('wallet.index') }}"><i class="fa fa-credit-card"></i> Wallet </a></li>
                </ul>
                @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"> <i class="glyphicon glyphicon-text-background"></i> Login</a></li>
                        <li><a href="{{ url('/register') }}"> <i class="glyphicon glyphicon-registration-mark"></i> Register</a></li>
                    @else
                        
                                <li><a href="http://twitter.com"> <i class="fa fa-twitter-square"> </i> </a></li>
                                <li><a href="http://twitter.com"> <i class="fa fa-facebook-official"> </i> </a></li>
                                <li><a href="http://instagram.com"><i class="fa fa-instagram" ></i></a></li>
                        

                        <li class="dropdown">
                            <?php $avatar = "http://192.168.56.56/Laravel1/public/upload/images/".Auth::user()->avatar; ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             <img src="{{$avatar}}" alt="Avatar" width="20" height="16">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            
                            <ul class="dropdown-menu" role="menu">
                                <li> <a href="{{ route('getUpdate', Auth::user()->id) }}"><i class="glyphicon glyphicon-user"></i> Infomation </a> </li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- clock normal -->
    <div id="clock" style="font-size: 30px; display: inline-block; padding-left: 15px;" ></div>


    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src ="{{ url('public/js/myscript.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script type="text/javascript">
    function time() {
       var today = new Date();
       var weekday=new Array(7);
       weekday[0]="Sunday";
       weekday[1]="Monday";
       weekday[2]="Tuesday";
       weekday[3]="Wednesday";
       weekday[4]="Thursday";
       weekday[5]="Friday";
       weekday[6]="Saturday";
       var day = weekday[today.getDay()]; 
       var dd = today.getDate();
       var mm = today.getMonth()+1; //January is 0!
       var yyyy = today.getFullYear();
       var h=today.getHours();
       var m=today.getMinutes();
       var s=today.getSeconds();
       m=checkTime(m);
       s=checkTime(s);
       nowTime = h+":"+m+":"+s;
       if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = day+', '+ dd+'/'+mm+'/'+yyyy;
     
       tmp='<span class="date">'+today+' | '+nowTime+'</span>';
     
       document.getElementById("clock").innerHTML="Ha Noi, "+tmp;
     
       clocktime=setTimeout("time()","1000","JavaScript");
       function checkTime(i)
       {
          if(i<10){
         i="0" + i;
          }
          return i;
       }
    }
</script>
</body>
</html>
