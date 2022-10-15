@extends('layouts.baseframe')

@section('title', '错误')

@section("css")
<style>
    body{
    /* background-color: #fff; */
}
.error-page {
    height: 100%;
    position: fixed;
    width: 100%;
}
.error-body {
    padding-top: 5%;
}
.error-body h1 {
    font-size: 210px;
    font-weight: 700;
    text-shadow: 4px 4px 0 #f5f6fa, 6px 6px 0 #33cabb;
    line-height: 210px;
    color: #33cabb;
}
.error-body h4 {
    margin: 30px 0px;
}
</style>
@endsection

@section('content')
<section class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>{{ $code ?? "404" }}</h1>
            <h4>好像发生了错误：{{ $msg }},{{--<i id="wait">3</i>秒钟之后将自动跳转，--}}</h4>
            <a href="javascript:;" onclick="goNow()" class="btn btn-primary ">返回</a>
        </div>
    </div>
</section>

<script type="text/javascript">
    (function() {
        var wait = document.getElementById('wait');

        if(!wait) wait = 3;
        var interval = setInterval(function() {
            var time = --wait.innerHTML;
            if (time <= 0) {
                goNow();
                clearInterval(interval);
            }
            ;
        }, 1000);
    })();

    function goNow() {
        history.go(-1);
    }
</script>
@endsection
