{extend name="layout/layout" /}

{block name="content"}
{include file="layout/carousel" /}
<div class="container projects">
    <div class="row">
        <div class="col-sm-85">
            <div class="list-group list-group-primary">
                {foreach $quickSearch as $key => $first}
                <a href="#id-{$first.id}" class="list-group-item">{$first.name}</a>
                {/foreach}
            </div>
        </div>
        <div class="col-sm-335">
            {foreach $quickSearch as $key => $first}
            <div class="field-set">
                <div id="id-{$first.id}" class="legend">{$first.name}</div>
                {if $first.sites}
                <div class="row">
                    {foreach $first.sites as $site}
                    <div class="col-sm-210 col-md-105">
                        <div class="classify">
                            <div class="classify-header ellipsis">
                                <a href="{$site.url}" title="{$site.title}">{$site.title}</a>
                            </div>
                            <div class="classify-body">
                                <p class="ellipsis-2">{$site.description}</p>
                            </div>
                        </div>
                    </div>
                    {/foreach}
                </div>
                {/if}
            </div>
            {/foreach}
        </div>
    </div>
</div>
{/block}



