{extend name="layout/layout" /}

{block name="content"}
{include file="layout/carousel" /}

<div class="container projects">
    <div class="row">
        <div class="col-sm-85">
            <div class="list-group list-group-primary">
                {foreach $quickSearch as $key => $first}
                <li role="presentation" class="list-group-item"><a href="#id-{$first.id}">{$first.name}</a></li>
                {/foreach}
            </div>
        </div>
        <div class="col-sm-335">
            {foreach $quickSearch as $key => $first}
            <div class="field-set">
                <div id="id-{$first.id}" class="legend">{$first.name}</div>
                {if $first.sites}
                <div class="row">
                    <div class="col-sm-420">
                        {foreach $first.sites as $site}
                        <div class="classify">
                            <div class="classify-header ellipsis">
                                <svg height="15" style="color: #6a737d" class="octicon octicon-repo" viewBox="0 0 16 16" version="1.1" width="16" aria-hidden="true"><path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path></svg>
                                <a href="{$site.url}" class="underline" title="{$site.title}">{$site.title}</a>
                            </div>
                            <div class="classify-body">
                                <p class="ellipsis-2">{$site.description}</p>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                </div>
                {/if}
            </div>
            {/foreach}
        </div>
    </div>
</div>
{/block}



