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
                <h3 className="text-center">新词列表</h3>
                <ol class="breadcrumb">
                    <?php if($no==0){
                    echo '<li><a href="/english/mottoList/">返回内容列表</a></li>';}
                     elseif($no==1){
                        echo'<li><a href="/english/videosList/">返回内容列表</a></li>';
                        }
                    elseif($no==2)
                         {
                             echo'<li><a href="/english/articleList/">返回内容列表</a></li>';
                         }
                        ?>
                    <li><a href="/english/addNewWord/{{$id}}/type/{{$no}}">添加新词</a></li>
                </ol>
               <table class="table table-bordered" style="margin-top: 20px">
                <tr>
                <td>序号</td>
                    <td>标题</td>
                    <td>编辑</td>
                    <td>删除</td>
                </tr>
                   @foreach ($wordList as $word)
                <tr>
                    <td>{{$word->id}}</td>
                    <td>{{$word->word}}</td>
                    <td><a href="/english/editNewWord/{{$word->id}}/mottoID/{{$id}}/type/{{$no}}">编辑</a>
                    </td>
                    <td>
                        <form method="post" action="/api/english/delWord/{{$word->id}}/mottoID/{{$word->mottoId}}/type/{{$no}}">
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-link" onclick="javascript:if(window.confirm('你确定删除？')){return true;}else{return false;}">删除</button></form>
                    </td>
                </tr>
                   @endforeach

               </table>
                <div style="text-align: center">
                    {{ $wordList->links() }}
                </div>
            </div>
            <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
            <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
