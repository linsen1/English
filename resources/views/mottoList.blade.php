<!doctype html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>内容列表</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

            <div class="container">
                <h3 className="text-center">内容列表</h3>
                <ol class="breadcrumb">
                    <li><a href="/english/mottoAdd">添加内容</a></li>
                </ol>
               <table class="table table-bordered" style="margin-top: 20px">
                <tr>
                <td>序号</td>
                    <td>标题</td>
                    <td>编辑</td>
                    <td>删除</td>
                </tr>
                   @foreach ($mottoList as $motto)
                <tr>
                    <td>{{$motto->id}}</td>
                    <td>{{$motto->englishWord}}</td>
                    <td><a href="/english/editMotto/{{$motto->id}}">短句</a>
                    &nbsp;&nbsp;<a href="/english/editNewWordList/{{$motto->id}}/type/0">单词</a>
                    </td>
                    <td>
                        <form method="post" action="/api/english/del/{{$motto->id}}">
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-link" onclick="javascript:if(window.confirm('你确定删除？')){return true;}else{return false;}">删除</button></form>
                    </td>
                </tr>
                   @endforeach

               </table>
                <div style="text-align: center">
                    {{ $mottoList->links() }}
                </div>
            </div>
            <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
