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
                <h3 class="text-center">编辑信息</h3>
                <div style="text-align: left;margin-top: 10px">
                  <form class="form-horizontal" method="post" action="/api/english/edit/{{$motto[0]->id}}" >
                      <div class="form-group">
                      <label class="col-sm-2 control-label text-right" for="englishWord">英语:</label>
                          <div class="col-sm-10">
                             <textarea class="form-control " id="englishWord" name="englishWord" rows="3">{{$motto[0]->englishWord}}</textarea>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="chineseWord">中文:</label>
                          <div class="col-sm-10">
                              <textarea class="form-control " id="chineseWord" name="chineseWord" rows="3">{{$motto[0]->chineseWord}}</textarea>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="xiaobian">小编:</label>
                          <div class="col-sm-10">
                              <textarea class="form-control " id="xiaobian" name="xiaobian" rows="3">{{$motto[0]->xiaobian}}</textarea>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label text-right" for="pic">图片:</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control " id="pic" name="pic" value="{{$motto[0]->pic}}">
                          </div>
                      </div>
                      <div style="text-align: center">
                          <button type="submit" class="btn btn-default" style="vertical-align: middle;text-align: center; ">修改</button>
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
