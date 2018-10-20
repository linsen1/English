<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加故事</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
    <h3 class="text-center">添加相关故事</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/story/addStory" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="storyTitle">故事标题:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="storyTitle" name="storyTitle" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="type">分类：</label>
                <div class="col-sm-10">
                    <select name="storyClassID" id="storyClassID" class="form-control " >
                        @foreach ($storyClass as $class)
                        <option  value="{{$class->id}}" >{{$class->storyClassName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="storyImg">故事图片:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="storyImg"  id="storyImg" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="storyAudio">音频地址:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="storyAudio"  id="storyAudio" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="storyabout">故事简介:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="storyabout" name="storyabout" rows="6"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="storyEN">英文内容:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="storyEN" name="storyEN" rows="20"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="storyCN">中文内容:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="storyCN" name="storyCN" rows="20"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="storyENCN">中英内容:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="storyENCN" name="storyENCN" rows="30"></textarea>
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

</body>
</html>
