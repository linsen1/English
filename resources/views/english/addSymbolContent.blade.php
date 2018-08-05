<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加音标基础内容</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
    <h3 class="text-center">添加音标基础内容</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/symbol/addSymbolContent/{{$id}}" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="speakVideo">发音视频:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="speakVideo"  id="speakVideo" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="speakImgUrl">发音图片:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="speakImgUrl"  id="speakImgUrl" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="speakAbout">发音文字描述:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="speakAbout" name="speakAbout" rows="20"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="speakWord">发音代言词:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="speakWord" name="speakWord" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="speakWordImg">代言词图片:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="speakWordImg"  id="speakWordImg" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="speakWordMp3">代言词音频:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="speakWordMp3"  id="speakWordMp3" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="name">代言词中文释义:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="speakWordChinese" name="speakWordChinese" >
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

<!-- Include Editor JS files. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/froala_editor.pkgd.min.js"></script>

<script> $(function() { $('#speakAbout').froalaEditor() }); </script>
</body>
</html>
