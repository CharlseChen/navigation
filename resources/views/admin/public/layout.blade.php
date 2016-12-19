<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>军民融合导航网后台管理系统</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{asset('static/css/bootstrap/css/bootstrap.min.css')}}">
        <link href="{{ asset('/static/css/icheck/all.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/static/js/scojs/sco.message.css') }}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('static/css/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="{{asset('css/admin/skins/skin-blue.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/web_mark.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini @if($sidebar_collapse) sidebar-collapse @endif">
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Navigtion</b>CMS</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Navigation</b>CMS</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- Notifications Menu -->
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{asset('css/admin/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{Auth::User()->name}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{asset('css/admin/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                                    </li>
                                    <!-- Menu Body -->
                                    <!--              <li class="user-body">
                                                    <div class="row">
                                                      <div class="col-xs-4 text-center">
                                                        <a href="#">Followers</a>
                                                      </div>
                                                      <div class="col-xs-4 text-center">
                                                        <a href="#">Sales</a>
                                                      </div>
                                                      <div class="col-xs-4 text-center">
                                                        <a href="#">Friends</a>
                                                      </div>
                                                    </div>
                                                     /.row 
                                                  </li>-->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <!--                    跳转至首页-->
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{route('admin.account.logout')}}" class="btn btn-default btn-flat">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    @include('admin/public/menu')
                </section>
                <!-- /.sidebar -->



            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @yield('content')
            </div><!-- /.content-wrapper -->

            @include('admin/public/footer')

        </div><!-- ./wrapper -->

        <!--scripts-->
        @include('admin/public/script')

        @yield('script')

    </body>
</html>
