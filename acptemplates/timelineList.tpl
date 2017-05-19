{include file='header' pageTitle='wcf.acp.timeline.list'}

<script data-relocate="true">
	//<![CDATA[
	$(function () {
		new WCF.Action.Delete('wcf\\data\\timeline\\TimelineAction', '.jsTimelineRow');
	});
	//]]>
</script>

<header class="boxHeadline">
	<h1>{lang}wcf.acp.timeline.list{/lang}</h1>
</header>

<div class="contentNavigation">
	<nav>
		<ul>
			<li><a href="{link controller='TimelineAdd'}{/link}" class="button"><span class="icon icon16 fa-plus"></span> <span>{lang}wcf.acp.timeline.add{/lang}</span></a></li>

			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

{hascontent}
	<div class="paginationTop">
		{content}{pages print=true assign=pagesLinks controller="TimelineList" link="pageNo=%d&sortField=$sortField&sortOrder=$sortOrder"}{/content}
	</div>
{/hascontent}

{if $objects|count}
	<div class="tabularBox marginTop">
		<table data-type="de.fabihome.wsc.timeline" class="table jsClipboardContainer">
			<thead>
				<tr>
					<th class="columnID columnTimelineID{if $sortField == 'timelineID'} active {@$sortOrder}{/if}" colspan="2"><a href="{link controller='TimelineList'}pageNo={@$pageNo}&sortField=timelineID&sortOrder={if $sortField == 'timelineID' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.global.objectID{/lang}</a></th>
					<th class="columnTitle{if $sortField == 'title'} active {@$sortOrder}{/if}"><a href="{link controller='TimelineList'}pageNo={@$pageNo}&sortField=title&sortOrder={if $sortField == 'title' && $sortOrder == 'ASC'}DESC{else}ASC{/if}{/link}">{lang}wcf.acp.timeline.title{/lang}</a></th>
					<th class="columnDate{if $sortField == 'date'} active {@$sortOrder}{/if}"><a href="{link controller='TimelineList'}pageNo={@$pageNo}&sortField=date&sortOrder={if $sortField == 'date' && $sortOrder == 'ASC'}DESC{else}ASC{/if}&search={/link}">{lang}wcf.acp.timeline.date{/lang}</a></th>

					{event name='columnHeads'}
				</tr>
			</thead>

			<tbody>
				{foreach from=$objects item=timeline}
					<tr class="jsTimelineRow jsClipboardObject">
						<td class="columnIcon">
							<a href="{link controller='TimelineEdit' id=$timeline->timelineID}{/link}" title="{lang}wcf.global.button.edit{/lang}" class="jsTooltip"><span class="icon icon16 fa-pencil"></span></a> <span class="icon icon16 fa-times jsDeleteButton jsTooltip pointer" title="{lang}wcf.global.button.delete{/lang}" data-object-id="{@$timeline->timelineID}" data-confirm-message="{lang}wcf.acp.timeline.delete.sure{/lang}"></span>

							{event name='rowButtons'}
						</td>
						<td class="columnID">{$timeline->timelineID}</td>
						<td class="columnTitle"><a href="{link controller='TimelineEdit' id=$timeline->timelineID}{/link}">{$timeline->title}</a></td>
						<td class="columnDate">{@$timeline->date|date}</td>

						{event name='columns'}
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>

	<div class="contentNavigation">
		{@$pagesLinks}

		<nav>
			<ul>
				<li><a href="{link controller='TimelineAdd'}{/link}" class="button"><span class="icon icon16 fa-plus"></span> <span>{lang}wcf.acp.timeline.add{/lang}</span></a></li>

				{event name='contentNavigationButtonsBottom'}
			</ul>
		</nav>
	</div>
{else}
	<p class="info">{lang}wcf.global.noItems{/lang}</p>
{/if}

{include file='footer'}
