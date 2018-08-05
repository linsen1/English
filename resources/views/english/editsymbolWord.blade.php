<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>编辑相关单词</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 class="text-center">编辑相关单词</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/symbol/editsymbolWords/{{$id}}/PID/{{$PID}}" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="ENword">英文单词:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="ENword" name="ENword"  value="{{$symbolWord->ENword}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="wordSymbol">音标:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="wordSymbol" name="wordSymbol"  value="{{$symbolWord->wordSymbol}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="CNword">中文释义:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="CNword" name="CNword" value="{{$symbolWord->CNword}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="ENwordMp3URL">音频地址:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="ENwordMp3URL" name="ENwordMp3URL" value="{{$symbolWord->ENwordMp3}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="ENwordMp3">单词音频:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="ENwordMp3"  id="ENwordMp3" >
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
