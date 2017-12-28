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
                <h3 class="text-center">添加内容</h3>
                <div style="text-align: left;margin-top: 10px">
                  <form class="form-horizontal" method="post" action="/api/english/addNewWord/{{$id}}" >
                      <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="word">单词:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control " id="word" name="word" >
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="yinbiao">英式音标:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control " id="yinbiao" name="yinbiao" >
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="yinbiaoMp3">英式MP3:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control " id="yinbiaoMp3" name="yinbiaoMp3" >
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="yinbiao1">美式音标:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control " id="yinbiao1" name="yinbiao1" >
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="yinbiao1Mp3">美式MP3:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control " id="yinbiao1Mp3" name="yinbiao1Mp3" >
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="chinese">中文:</label>
                          <div class="col-sm-10">
                              <textarea class="form-control " id="chinese" name="chinese" rows="5"></textarea>
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
