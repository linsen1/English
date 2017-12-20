<!doctype html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

            <div class="container">
                <div id="root" style="margin-top: 20px"></div>
            </div>
            <script src="{{mix('js/app.js')}}"></script>
            <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
