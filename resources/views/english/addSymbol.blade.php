<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>添加基础音标</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 class="text-center">添加基础音标</h3>
    <div style="text-align: left;margin-top: 10px">
        <form class="form-horizontal" method="post" action="/api/english/symbol/addSymbol" >
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="name">字母:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="title" name="title" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="type">分类：</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control " >
                        <option  value="0">前元音</option>
                        <option value="1">中元音</option>
                        <option value="2">后元音</option>
                        <option value="3">双元音</option>
                        <option value="4">辅音</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="orderflag">顺序:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="orderflag" name="orderflag" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label text-right" for="typeflag">分类标识:</label>
                <div class="col-sm-10">
                    <select name="typeflag" id="typeflag" class="form-control " >
                        <option  value="0">否</option>
                        <option value="1">是</option>
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
