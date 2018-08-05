<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>编辑常见字母组合</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 class="text-center">编辑常见字母组合</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/symbol/editWordsGroup/{{$id}}/PID/{{$PID}}" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="wordGroup">字母组合:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="wordGroup" name="wordGroup"  value="{{$symbolWordsgroup->wordGroup}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="Words">相关单词:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="Words" name="Words" value="{{$symbolWordsgroup->Words}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="WordsMp3">单词音频地址:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text"  name="WordsMp3URL"  id="WordsMp3URL"  value="{{$symbolWordsgroup->WordsMp3}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="WordsMp3">单词音频:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="WordsMp3"  id="WordsMp3" >
                </div>
            </div>

            <div style="text-align: center">
                <button type="submit" class="btn btn-default" style="vertical-align: middle;text-align: center; ">编辑</button>
            </div>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
