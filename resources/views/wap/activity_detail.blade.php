<!DOCTYPE html>
<html class="no-js" lang="zh-CN" data-dpr="3" style="font-size: 108px;">>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ systemconfig('site_title') ?? 'motoo' }} -- 活动办理大厅</title>
    <meta name="keywords" content="{{ systemconfig('site_keyword') }}">
    
    <meta name="viewport"
          content="width=1080,initial-scale=0.3333333333333333,maximum-scale=0.3333333333333333, minimum-scale=0.3333333333333333,user-scalable=no">
    <link rel="shortcut icon" href="/img/9170/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/web/css/activity/mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/activity/mobile9170.css') }}">

</head>

<body>
    <div class="body-wrap">
        <header class="header">
            <h1 class="logo"></h1>
            <span class="slogan"></span>
        </header>

        <div class="wrapper">
            <section class="detail">
                <h2 class="tle">{{ $activity->title }}</h2>

                <div class="des" id="activeContent">
                    <h3>
                        <strong><span style="color:#F8A000">活动详情</span></strong>
                    </h3>
                </div>

                {!! $activity->content !!}

            </section>
            <div class="listbox-tip">
                <div class="btns">
                    <a href="{{ route('web.activity.list') }}"></a>
                </div>

                <p class="form_p">
                    <span
                        style="color:#F50307">温馨提示：</span>请点击对应活动类别申请，由于申请人众多，请勿重复提交，提交申请后专员将于30分钟内审核办理，提交申请后可以点击审核进度查询！
                    <br>
                    <span style="color:#F50307">特别声明：</span>符合哪个活动就提交申请该活动，必须符合条件的客户方可提交申请，以免导致影响您失去该优惠申请资格；谢谢！</p>
                <p></p>
            </div>
        </div>
    </div>


</body>

</html>
