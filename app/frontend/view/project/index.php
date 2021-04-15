{extend name="layout/layout" /}

{block name="content"}

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
                <div class="legend">优秀项目</div>
                <div class="row">
                    {for start="1" end="10"}
                    <div class="col-sm-420">
                        <div class="classify">
                            <div class="classify-header ellipsis">
                                <svg height="15" style="color: #6a737d" class="octicon octicon-repo" viewBox="0 0 16 16" version="1.1" width="16" aria-hidden="true"><path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path></svg>
                                <a href="#" class="underline">Eaglering/Masiemei huameielele</a>
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



