<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加幻灯</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="container">
    <h3 class="text-center">添加首页幻灯</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/homeBanners/addBanner" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="title">幻灯标题:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="title" name="title" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="ref_id">幻灯内容主键:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="ref_id" name="ref_id" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="imgurl">幻灯图片:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file"  name="imgurl"  id="imgurl" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="type">分类：</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control " >
                        <option  value="0" >首页幻灯</option>
                        <option value="1" >名句</option>
                        <option value="2">文章</option>
                        <option value="3" >电影</option>
                        <option value="4" >歌曲</option>
                    </select>
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
