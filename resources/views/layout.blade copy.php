<!-- layout.blade.php -->
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>承德文創 - @yield('title')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
        @section('header')
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <ul class="nav nav-pills sub_title">
                        <li class="title"><a href="/" style="color: #636b6f;">丞德</a></li>
                        <li role="presentation"><a href="/punch">打卡</a></li>
                        <div class="dropdown" style="margin-top: 1%;">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                報價
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">HTML</a></li>
                                <li ><a href="#">CSS</a></li>
                                <li><a href="#">JavaScript</a></li>
                            </ul>
                        </div>
                        <li role="presentation"><a href="/admin"><b>Admin</b></a></li>                   
                    </ul>
                </div>
            </div>
        </nav>
        @show
        </header>

        <nav>
        </nav>

        <section>
            <style>
                html, body {
                    background-color: #fff;
                    color: #636b6f;
                    font-family: 'Raleway', sans-serif;
                    /*font-weight: 100;*/
                    margin: 0;
                    width: auto;
                }

                .full-height {
                    height: 100vh;
                }

                .flex-center {
                    align-items: center;
                    display: flex;
                    justify-content: center;
                }

                .position-ref {
                    position: relative;
                }

                .top-right {
                    position: absolute;
                    right: 10px;
                    top: 18px;
                }

                .content {
                    text-align: center;
                }

                .links > a {
                    color: #636b6f;
                    padding: 0 5px;
                    font-size: 30px;
                    font-weight: 600;
                    letter-spacing: .1rem;
                    text-decoration: none;
                }

                .m-b-md {
                    margin-bottom: 30px;
                }

                .title {
                    font-size:40px;
                }

                .sub_title {
                    font-size: 30px;
                    display: flex;
                }
            </style>
            @yield('content')
        </section>

        <footer>
            <div id="copyright text-right">© Copyright 2020</div>
        </footer>

    </body>
</html>