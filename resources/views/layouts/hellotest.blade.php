<html>
<head>
    <title>@yield('title')</title>
    <style>
    body {font-size:16pt; color:#999; margin:5px;}
    h1 {font-size:30pt; text-align:center; color:#f6f6f6;}
    ul {font-size:12pt;}
    .menutitle {font-size:14pt; font-weight:bold; margin: 0px;}
    .content {margin:10px}
    .footer {text-align:right; font-size:10pt; margin:10px; border-bottom:solid 1px #ccc; color:#ccc;}
    .profile_box {background-color:#fdf5e6;}
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <h1>@yield('title')</h1>
    @section('menubar')
    <h2>メニュー</h2>
    <ul>
        <li>@show</li>
    </ul>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        @yield('footer')
    </div>
</body>
</html>