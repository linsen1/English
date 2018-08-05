<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加相关句子</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 class="text-center">添加相关句子</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/symbol/addSymbolSentence/{{$id}}" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="ENSentence">英文句子:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="ENSentence" name="ENSentence" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="CNSentence">中文释义:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="CNSentence" name="CNSentence" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="SentenceMp3">句子音频:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="SentenceMp3"  id="SentenceMp3" >
                </div>
            </div>

            <div style="text-align: center">
                <button type="submit" class="btn btn-default" style="vertical-align: middle;text-align: center; ">添加</button>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
