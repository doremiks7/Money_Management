@extends('layouts.app')
@section('content')
<style type="text/css">

@media(min-width:768px){ .sidebar 
    {
        z-index: 1;
        position: absolute;
        width: 250px;
        margin-top: 51px;
    }
}

@media (min-width: 768px)
{
    #page-wrapper {
        position: inherit;
        margin: 0 0 0 250px;
        padding: 0 30px;
        border-left: 1px solid #e7e7e7;
    }
}   
.sidebar .sidebar-search {
    padding: 15px;
}

.sidebar ul li {
    border-bottom: 1px solid #e7e7e7;
}

.nav>li {
    position: relative;
    display: block;
}

ul li {
    list-style: none;
}

a{
    color: #333;
    text-decoration: none;
}

.color-money{
    color: rgb(208, 2, 27);
    font-weight: bold;
}

.color-expense{
    color: #d9534f;
}

.color-income{
    color: #007E33;
}
</style>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">Admin Area</a>
            </div>
            <!-- /.navbar-header -->

        
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="{{ route('wallet.index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#wallet"><i class="fa fa-bar-chart-o fa-fw"></i> Wallet<span class="fa fa-angle-right" style="float:right;"></span></a>
                            <ul id="wallet" class="nav nav-second-level collapse" aria-expanded="false" style>
                                <li>
                                    <a href="{{ route('wallet.index') }}">List Wallet</a>
                                </li>
                                <li>
                                    <a href="{{ route('wallet.create') }}">Add Wallet</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#category"><i class="fa fa-cube fa-fw"></i> Category<span class="fa fa-angle-right " style="float:right;"></span></a>
                            <ul id="category" class="nav nav-second-level collapse" aria-expanded="true" >
                                <li>
                                    <a href="{{route('category.index')}}">List Category</a>
                                </li>
                                <li>
                                    <a href="{{route('category.create')}}">Add Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#transaction"><i class="fa fa-users fa-fw"></i> Transaction<span class="fa fa-angle-right" style="float:right;"></span></a>
                            <ul id="transaction" class="nav nav-second-level collapse" aria-expanded="true">
                                <li>
                                    <a href="{{route('transaction.index')}}">List Transaction</a>
                                </li>
                                <li>
                                    <a href="{{route('transaction.create')}}">Add Transaction</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#" data-toggle="collapse" data-target="#transfer"><i class="fa fa-dollar"></i> Transfer <span class="fa fa-angle-right" style="float:right;"></span></a>
                            <ul id="transfer" class="nav nav-second-level collapse" aria-expanded="true">
                                <li>
                                    <a href="{{route('historyTransfer')}}">List Transfer</a>
                                </li>
                                <li>
                                    <a href="{{route('getTransfer')}}">Transfer Money</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper" style="min-height: 568px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> @yield('controller')
                            <small>@yield('action')</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <!-- Content chứa nội dung -->
                    
                        @yield('noidung')
                        
                    <!-- EndContent chứa nội dung -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });

    </script>
    <script type="text/javascript">
        function myfunction(name_id){
            alert(name_id);
        document.getElementById(name_id).style.display = "block";
    }
    </script>

<script type="text/javascript">
    $(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
            topOffset = 50;
            width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
            if (width < 768) {
                $('div.navbar-collapse').addClass('collapse');
                topOffset = 100; // 2-row-menu
            } else {
                $('div.navbar-collapse').removeClass('collapse');
            }

            height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
            height = height - topOffset;
            if (height < 1) height = 1;
            if (height > topOffset) {
                $("#page-wrapper").css("min-height", (height) + "px");
            }
        });

        var url = window.location;
        var element = $('ul.nav a').filter(function() {
            return this.href == url;
        }).addClass('active').parent().parent().addClass('in').parent();
        if (element.is('li')) {
            element.addClass('active');
        }
    });
</script>
@endsection