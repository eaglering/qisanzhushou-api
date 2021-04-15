{extend name="layout/layout" /}

{block name="content"}
{include file="layout/carousel" /}

<div class="container projects">
    <div class="panel-box panel-box-lg">
        <div class="row">
            {foreach $hot as $site}
            <div class="col-sm-84 col-lg-60">
                <div class="classify-fast ellipsis">
                    <img class="lazy" src="{$base_asset}/images/space.png" width="18" height="18" data-src="{$site.favicon}"/>
                    <a href="{$site.url}" title="{$site.title}">{$site.title}</a>
                </div>
            </div>
            {/foreach}
        </div>
    </div>
    <div class="tab">
        <ul class="nav nav-pills">
            {foreach $quickSearch as $key => $first}
            <li role="presentation" {if !$key}class="active"{/if} data-target="#id-{$first.id}"><a href="javascript:;">{$first.name}</a></li>
            {/foreach}
        </ul>
        {foreach $quickSearch as $key => $first}
        <div id="id-{$first.id}" class="tab-content" {if $key}style="display: none"{/if}>
            {if $first.sites}
            <div class="field-set">
                <div class="row">
                    {foreach $first.sites as $site}
                    <div class="col-sm-210 col-md-105 col-lg-84">
                        <div class="classify">
                            <div class="classify-header ellipsis">
                                <img class="lazy" src="{$base_asset}/images/space.png" height="29" data-src="{$site.favicon}"/>
                                <a href="{$site.url}" title="{$site.title}">{$site.title}</a>
                            </div>
                            <div class="classify-body">
                                <p class="ellipsis-2">{$site.description}</p>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
            </div>
            {/if}
            {if $first.children}
            {foreach $first.children as $second}
            <div class="field-set">
                <div class="legend">{$second.name}</div>
                <div class="row">
                    {if $second.sites}
                    {foreach $second.sites as $site}
                    <div class="col-sm-210 col-md-105 col-lg-84">
                        <div class="classify">
                            <div class="classify-header ellipsis">
                                <img class="lazy" src="{$base_asset}/images/space.png" height="29" data-src="{$site.favicon}"/>
                                <a href="{$site.url}" title="{$site.title}">{$site.title}</a>
                            </div>
                            <div class="classify-body">
                                <p class="ellipsis-2">{$site.description}</p>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                    {/if}
                </div>
            </div>
            {/foreach}
            {/if}
        </div>
        {/foreach}
    </div>
    <div class="panel-box">
        {foreach $comprehensive as $key => $first}
        {if $first.sites}
        <div class="row navigator">
            <div class="col-sm-50 col-sm-offset-10 legend">
                <span>{$first.name}</span>
            </div>
            {foreach $first.sites as $site}
            <div class="col-sm-50 ellipsis">
                <a class="link" href="{$site.url}" title="{$site.title}">{$site.title}</a>
            </div>
            {/foreach}
        </div>
        {/if}
        {/foreach}
    </div>
</div>
{/block}

{block name="external_javascript"}
<script type="text/javascript">
    $(function () {
        $('.tab>.nav>li').click(function () {
            var _this = $(this), target = _this.data('target');
            if (_this.hasClass('.active')) return;
            _this.siblings().removeClass('active');
            _this.addClass('active');
            $('.tab>.tab-content').hide();
            $(target).show();
        });
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
{/block}


