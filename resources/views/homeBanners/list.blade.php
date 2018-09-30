<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>站点幻灯管理</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h3 className="text-center">站点幻灯</h3>
    <ol class="breadcrumb">
        <li><a href="/english/homeBanners/addBanner">添加幻灯</a></li>
    </ol>
    <table class="table table-bordered" style="margin-top: 20px">
        <tr>
            <td>序号</td>
            <td>标题</td>
            <td>类型</td>
            <td>编辑</td>
            <td>删除</td>
        </tr>
        @foreach ($banners as $banner)
            <tr>
                <td>{{$banner->id}}</td>
                <td>{{$banner->title}}</td>
                <td> @if($banner->type===0) 首页幻灯 @elseif($banner->type===1) 名句 @elseif($banner->type===2) 文章 @elseif($banner->type===3) 影视 @elseif($banner->type===4) 歌曲 @endif </td>
                <td>
                    &nbsp;<a href="/english/homeBanners/editBanner/{{$banner->id}}">编辑</a>&nbsp;&nbsp;
                </td>
                <td>
                    <form method="post" action="/api/english/homeBanners/delBanner/{{$banner->id}}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-link" onclick="javascript:if(window.confirm('你确定删除？')){return true;}else{return false;}">删除</button></form>
                </td>
            </tr>
        @endforeach

    </table>
    <div style="text-align: center">
        {{ $banners ->links() }}
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
