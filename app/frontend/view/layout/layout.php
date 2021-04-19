<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>{block name="title"}程序之窗{/block}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{block name='description'}程序之窗是一个开源的网址导航项目，具有完整的前后端，你可以拿来制作自己的网址导航。{/block}">
    <meta name="keywords" content="{block name='keyword'}网址导航,程序之窗,THINKPHP6,D2admin,Bootstrap,在线工具,开源项目{/block}">
    <meta name="author" content="{block name='author'}Eaglering{/block}">
    <meta name="robots" content="index,follow">
    <meta name="application-name" content="{$Request.server.http_host}">

    <!--[if lt IE 9]>
    <script src="{$plugin_asset}/html5shiv.min.js"></script>
    <script src="{$plugin_asset}/respond.min.js"></script>
    <![endif]-->

    <link rel="canonical" href="http{if $Request.server.https}s{/if}://{$Request.server.http_host}/" />

    {block name="stylesheet"}
    <link href="{$plugin_asset}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$plugin_asset}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{$base_asset}/css/site.min.css" rel="stylesheet">
    {/block}
    {block name="external_stylesheet"}
    {/block}
    <script>
        var _hmt = _hmt || [];
        {if app()->isProd()}
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?6a2a7f8c2463f437c50636e29495f131";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
        {/if}
    </script>
</head>
<body>

<div class="navbar navbar-masthead">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-sm" href="{$base_url}">
                <img src="{$asset}/logo.png" alt="程序之窗"/>
            </a>
        </div>
        <div class="navbar-collapse collapse" role="navigation">
            <ul class="nav navbar-nav">
                {if $controller == 'index'}
                <li class="active"><a href="javascript:;">首页</a></li>
                {else}
                <li><a href="{$base_url}">首页</a></li>
                {/if}
                {if $controller == 'tool'}
                <li class="active"><a href="javascript:;">在线工具</a></li>
                {else}
                <li><a href="{:url('/tool/index')}">在线工具</a></li>
                {/if}
                {if $controller == 'project'}
                <li class="active"><a href="javascript:;">项目推荐</a></li>
                {else}
                <li><a href="{:url('/project/index')}">项目推荐</a></li>
                {/if}
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-sm">
                {if $controller == 'about'}
                <li class="active"><a href="javascript:;">关于</a></li>
                {else}
                <li><a href="{:url('/about/index')}">关于</a></li>
                {/if}
            </ul>
        </div>
    </div>
</div>

{block name="content"}{/block}

<footer class="footer ">
    <div class="container">
        <div class="row footer-top">
            <div class="col-md-210 col-lg-210">
                <h4>
                    <img src="{$asset}/logo-simple.png" height="50">
                </h4>
                <p>我们一直致力于为广大开发者提供更多的优质技术文档和辅助开发工具！</p>
            </div>
            <div class="col-md-210 col-lg-210">
                <div class="row about">
                    <div class="col-sm-105">
                        <h4>关于</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">关于我们</a></li>
                            <li><a href="#">广告合作</a></li>
                            <li><a href="#">友情链接</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-105">
                        <h4>联系方式</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://github.com/eaglering" title="程序之窗项目开源地址" target="_blank">GITHUB</a></li>
                            <li><a href="mailto:442958506@qq.com">电子邮件</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-105">
                        <h4>旗下网站</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" target="_blank">暂无</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-105">
                        <h4>特别致谢</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" target="_blank">暂无</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row footer-bottom">
            <ul class="list-inline text-center">
                <li><a href="http://www.beian.miit.gov.cn/" target="_blank">粤ICP备2021044385号</a></li>
            </ul>
        </div>
    </div>
</footer>

{block name="javascript"}
<script type="text/javascript" src="{$plugin_asset}/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{$plugin_asset}/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{$plugin_asset}/jquery.unveil/js/jquery.unveil.min.js"></script>
<script type="text/javascript" src="{$plugin_asset}/jquery.scrollUp/js/jquery.scrollUp.min.js"></script>
<script type="text/javascript" src="{$plugin_asset}/toc.min.js"></script>
<script type="text/javascript" src="{$plugin_asset}/jquery.matchHeight/js/jquery.matchHeight.min.js"></script>
<script type="text/javascript" src="{$base_asset}/js/site.min.js"></script>
{/block}
<script type="text/javascript">
    $(function () {
        $('.carousel ul.nav>li').click(function () {
            var _this = $(this), a = _this.find('a'), placeholder = a.data('placeholder');
            if (_this.hasClass('.active')) return;
            _this.siblings().removeClass('active');
            _this.addClass('active');
            $('.carousel .search input').attr('placeholder', placeholder)
        });
        $('.carousel .search input').keyup(function(e) {
            if (e.keyCode === 13) {
                $('.carousel .search button').trigger('click');
            }
        })
        $('.carousel .search button').click(function () {
            var value = $('.carousel .search input').val()
            if (value === '') return
            var dom = $('.carousel ul.nav>li.active'), a = dom.find('a'), href = a.data('href'),
                query = a.data('query');
            window.open(href + '?' + query + '=' + value);
        })
    });
</script>
{block name="external_javascript"}{/block}
</body>
</html>
