{extend name="layout/layout" /}

{block name="content"}
<div class="carousel">
    <div class="container">
        <div class="row">
            <div class="col-sm-200 col-sm-offset-100">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#">百度</a></li>
                    <li role="presentation"><a href="#">Google</a></li>
                    <li role="presentation"><a href="#">Github</a></li>
                    <li role="presentation"><a href="#">StackOverflow</a></li>
                    <li role="presentation"><a href="#">NPM</a></li>
                </ul>
                <div class="search input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="百度一下，你就知道">
                    <span class="input-group-btn">
                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container projects">
    <div class="row">
        <div class="col-sm-85">
            <div class="list-group list-group-primary">
                <a href="#" class="list-group-item active">文档教程</a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
            </div>
        </div>
        <div class="col-sm-335">
            <div class="field-set">
                <div class="legend">文档教程</div>
                <div class="row">
                    {for start="1" end="5"}
                    <div class="col-sm-210 col-md-105">
                        <div class="classify">
                            <div class="classify-header ellipsis">
                                <img class="lazy" src="{$base_asset}/images/space.png" height="29" data-src="{$upload_url}/20210311/ic-emberjs.png"/>
                                <a href="#">PHP中文手册种流行的通用脚</a>
                            </div>
                            <div class="classify-body">
                                <p class="ellipsis-2">PHP是一种流行的通用脚本语言，特别适合于web开发。PHP快速，灵活和实用，为您的博客到世界上最受欢迎的网站提供强大的支持。</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-210 col-md-105">
                        <div class="classify">
                            <div class="classify-header ellipsis">
                                <img class="lazy" src="{$base_asset}/images/space.png" height="29" data-src="{$upload_url}/20210311/ic-reactjs.png"/>
                                <a href="#">PHP中文手册</a>
                            </div>
                            <div class="classify-body">
                                <p class="ellipsis-2">PHP是一种流行的通用脚本语言，特别适合于web开发。PHP快速，灵活和实用，为您的博客到世界上最受欢迎的网站提供强大的支持。</p>
                            </div>
                        </div>
                    </div>
                    {/for}
                </div>
            </div>
        </div>
    </div>
</div>
{/block}



