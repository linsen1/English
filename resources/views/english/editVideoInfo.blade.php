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
    <h3 class="text-center">编辑视频</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/updateVideo/{{$id}}" >
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_title">标题:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_title" name="video_title" value="{{$videoinfo[0]->video_title}}" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_poster">封面:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_poster" name="video_poster"  value="{{$videoinfo[0]->video_poster}}" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_SDURL">标清地址:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_SDURL" name="video_SDURL" value="{{$videoinfo[0]->video_SDURL}}" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_SDdataSize">标清文件大小:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_SDdataSize" name="video_SDdataSize" value="{{$videoinfo[0]->video_SDdataSize}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_HDURL">高清地址:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_HDURL" name="video_HDURL" value="{{$videoinfo[0]->video_HDURL}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_HDdataSize">高清文件大小:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_HDdataSize" name="video_HDdataSize" value="{{$videoinfo[0]->video_HDdataSize}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_FHDURL">超清地址:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_FHDURL" name="video_FHDURL" value="{{$videoinfo[0]->video_FHDURL}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_FHDdataSize">超清文件大小:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="video_FHDdataSize" name="video_FHDdataSize" value="{{$videoinfo[0]->video_FHDdataSize}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_introduce">视频介绍:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="video_introduce" name="video_introduce" rows="5">{{$videoinfo[0]->video_introduce}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_dialog_bg">对话背景:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="video_dialog_bg" name="video_dialog_bg" rows="5">{{$videoinfo[0]->video_dialog_bg}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_dialog_english">原文:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="video_dialog_english" name="video_dialog_english" rows="10">{{$videoinfo[0]->video_dialog_english}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_dialog_chinese">翻译:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="video_dialog_chinese" name="video_dialog_chinese" rows="10">{{$videoinfo[0]->video_dialog_chinese}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="video_goldenSentence">影视金句:</label>
                <div class="col-sm-10">
                    <textarea class="form-control " id="video_goldenSentence" name="video_goldenSentence" rows="5">{{$videoinfo[0]->video_goldenSentence}}</textarea>
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
