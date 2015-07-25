<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="/css/app-bundle.css" />
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>

    </head>
    <body>

    	@include('shared.alert')
        
        @yield('content')
        
        <script src="/js/app-bundle.js"></script>
    </body>
</html>
