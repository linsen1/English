<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>短语内容</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 class="text-center">添加短语</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/updateSentence/id/{{$id}}/refID/{{$refID}}/type/{{$type}}" >
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="EnWords">英文:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="EnWords" name="EnWords" value="{{$sentenceInfo->EnWords}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="CnWords">中文:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="CnWords" name="CnWords" value="{{$sentenceInfo->CnWords}}" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="EnMp3">语音MP3:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="EnMp3" name="EnMp3" value="{{$sentenceInfo->EnMp3}}">
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
