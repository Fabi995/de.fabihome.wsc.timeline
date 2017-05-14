{include file='header' pageTitle='wcf.acp.timeline.list'}

<script data-relocate="true">
    //<![CDATA[
    $(function() {
        new WCF.Action.Delete('wcf\\data\\timeline\\TimelineAction', '.jsTimelineRow');
    });
    //]]>

</script>

<header class="contentHeader">
    <div class="contentHeaderTitle">
        <h1 class="contentTitle">{lang}wcf.acp.timeline.list{/lang}</h1>
    </div>

    <nav class="contentHeaderNavigation">
        <ul>
            <li><a href="{link controller='TimelineAdd'}{/link}" class="button"><span class="icon icon16 fa-plus"></span> <span>{lang}wcf.acp.timeline.add{/lang}</span></a></li>

            {event name='contentHeaderNavigation'}
        </ul>
    </nav>
</header>

{include file='formError'}

{if $items}
    <form action="{link controller='TimelineList'}{/link}" method="post">
        <section class="section">
            <h2 class="sectionTitle">{lang}wcf.global.filter{/lang}</h2>

            <dl>
                <dt></dt>
                <dd>
                    <input type="text" id="timelineSearch" name="search" value="{$search}" placeholder="{lang}wcf.acp.timeline.search.query{/lang}" autofocus class="medium">
                </dd>
            </dl>
        </section>

        <div class="formSubmit">
            <input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s">
            {@SECURITY_TOKEN_INPUT_TAG}
        </div>
    </form>
{/if}

{hascontent}
    <div class="paginationTop">
        {content}{pages print=true assign=pagesLinks controller="TimelineList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder&search=$search"}{/content}
    </div>
{/hascontent}

{if $objects|count}
    <div class="section tabularBox">
        <table data-type="de.fabihome.wsc.timeline" class="table jsClipboardContainer">
            <thead>
            <tr>
                <th class="columnID columnTimelineID{if $sortField == 'timelineID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='TimelineList'}pageNo={@$pageNo}&sortField=timelineID&sortOrder={if $sortField == 'timelineID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&search={@$search|rawurlencode}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
                <th class="columnTitle{if $sortField == 'title'} active {@$sortOrder}{/if}"><a href="{link controller='TimelineList'}pageNo={@$pageNo}&sortField=title&sortOrder={if $sortField == 'title' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&search={@$search|rawurlencode}{/link}">{lang}wcf.acp.timeline.title{/lang}</a></th>
                <th class="columnDate{if $sortField == 'date'} active {@$sortOrder}{/if}"><a href="{link controller='TimelineList'}pageNo={@$pageNo}&sortField=date&sortOrder={if $sortField == 'date' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&search={@$search|rawurlencode}{/link}">{lang}wcf.acp.timeline.date{/lang}</a></th>

                {event name='columnHeads'}
            </tr>
            </thead>

            <tbody>
            {foreach from=$objects item=timeline}
                <tr class="jsTimelineRow jsClipboardObject">
                    <td class="columnIcon">
                        <a href="{link controller='TimelineEdit' id=$timeline->timelineID}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 fa-pencil"></span></a>
                        <span class="icon icon16 fa-times jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$timeline->timelineID}" data-confirm-message-html="{lang __encode=true}wcf.acp.timeline.delete.sure{/lang}"></span>

                        {event name='rowButtons'}
                    </td>
                    <td class="columnID">{$timeline->timelineID}</td>
                    <td class="columnTitle"><a href="{link controller='TimelineEdit' id=$timeline->timelineID}{/link}" class="badge timeline">{$timeline->title}</a></td>
                    <td class="columnDate"><a href="{link controller='TimelineEdit' id=$timeline->timelineID}{/link}" class="badge timeline">{$timeline->date|date}</a></td>

                    {event name='columns'}
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>

    <footer class="contentFooter">
        {hascontent}
            <div class="paginationBottom">
                {content}{@$pagesLinks}{/content}
            </div>
        {/hascontent}

        <nav class="contentFooterNavigation">
            <ul>
                <li><a href="{link controller='TimelineAdd'}{/link}" class="button"><span class="icon icon16 fa-plus"></span> <span>{lang}wcf.acp.timeline.add{/lang}</span></a></li>

                {event name='contentFooterNavigation'}
            </ul>
        </nav>
    </footer>
{else}
    <p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}

{include file='footer'}