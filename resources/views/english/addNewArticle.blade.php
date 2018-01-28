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
    <h3 class="text-center">添加美文</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/addNewArticle" >
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="title">标题:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="title" name="title" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="note">引言:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="note" name="note" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="picUrl">图片地址:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="picUrl" name="picUrl" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="mp3URL">MP3地址:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="mp3URL" name="mp3URL" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="englishContent">英文:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="englishContent" name="englishContent" rows="20"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="chineseContent">中文:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="chineseContent" name="chineseContent" rows="20"></textarea>
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
