<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加相关歌曲</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
    <h3 class="text-center">添加相关歌曲</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/symbol/addSong" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="songName">歌曲名称:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="songName" name="songName" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="songImgSmall">缩略图:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="songImgSmall"  id="songImgSmall" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="songImgBig">封面大图:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="songImgBig"  id="songImgBig" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="songMp3">音频地址:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="songMp3"  id="songMp3" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="songMp3HD">音频地址(HD):</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="songMp3HD"  id="songMp3HD" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="singer">歌手:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="singer" name="singer" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="singerImg">歌手图片:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="singerImg"  id="singerImg" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="singerabout">歌手简介:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="singerabout" name="singerabout" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="songAbout">音乐简介:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="songAbout" name="songAbout" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="ENSong">歌词:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="ENSong" name="ENSong" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="CNSong">中文歌词:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="CNSong" name="CNSong" rows="10"></textarea>
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

<script> $(function() { $('#ENSong').froalaEditor() }); </script>
<script> $(function() { $('#CNSong').froalaEditor() }); </script>
</body>
</html>
