<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>音标列表</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 className="text-center">音标列表</h3>
    <ol class="breadcrumb">
        <li><a href="/english/symbol/addSymbol">添加音标</a></li>
    </ol>
    <table class="table table-bordered" style="margin-top: 20px">
        <tr>
            <td>序号</td>
            <td>标题</td>
            <td>编辑</td>
            <td>删除</td>
        </tr>
        @foreach ($symbols as $symbol)
            <tr>
                <td>{{$symbol->id}}</td>
                <td>{{$symbol->title}}</td>
                <td>
                    &nbsp;<a href="/english/symbol/editSymbol/{{$symbol->id}}">基础</a>&nbsp;&nbsp;
                    &nbsp;<a href="/english/symbol/symbolContentList/{{$symbol->id}}">基本内容</a>&nbsp;&nbsp;
                  <a href="/english/symbol/wordsGroupList/{{$symbol->id}}">字母组合</a>
                    <a href="/english/symbol/symbolWordsList/{{$symbol->id}}">单词</a>
                    <a href="/english/symbol/symbolPhraseList/{{$symbol->id}}">短语</a>
                    <a href="/english/symbol/symbolSentenceList/{{$symbol->id}}">句子</a>
                    <a href="/english/symbol/songsList/{{$symbol->id}}">歌曲</a>
                </td>
                <td>
                    <form method="post" action="/api/english/symbol/delSymbol/{{$symbol->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-link" onclick="javascript:if(window.confirm('你确定删除？')){return true;}else{return false;}">删除</button></form>
                </td>
            </tr>
        @endforeach

    </table>
    <div style="text-align: center">
        {{ $symbols ->links() }}
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
