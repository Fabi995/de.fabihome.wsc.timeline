{include file='header' pageTitle='wcf.acp.timeline.'|concat:$action}

<header class="contentHeader">
	<div class="contentHeaderTitle">
		<h1 class="contentTitle">{lang}wcf.acp.timeline.{$action}{/lang}</h1>
	</div>

	<nav class="contentHeaderNavigation">
		<ul>
			<li><a href="{link controller='TimelineList'}{/link}" class="button"><span class="icon icon16 fa-list"></span> <span>{lang}wcf.acp.menu.link.timeline.list{/lang}</span></a></li>

			{event name='contentHeaderNavigation'}
		</ul>
	</nav>
</header>

{include file='formError'}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<form method="post" action="{if $action == 'add'}{link controller='TimelineAdd'}{/link}{else}{link controller='TimelineEdit' id=$timeline->timelineID}{/link}{/if}">
	<div class="section">

		<dl{if $errorField == 'subject'} class="formError"{/if}>
			<dt><label for="subject">{lang}wcf.global.title{/lang}</label></dt>
			<dd>
				<input type="text" id="subject" name="subject" value="{$subject}" required autofocus class="long">
				{if $errorField == 'subject'}
					<small class="innerError">
						{if $errorType == 'empty'}
							{lang}wcf.global.form.error.empty{/lang}
						{/if}
					</small>
				{/if}
			</dd>
		</dl>

		<dl{if $errorField == 'icon'} class="formError"{/if}>
			<dt><label for="icon">{lang}wcf.global.icon{/lang}</label></dt>
			<dd>
				{include file='fontAwesomeSelectOptionType' iconSelectorKey='icon' iconSelectorValue=$icon iconSelectorAllowEmpty='1'}
			</dd>
		</dl>

		<dl{if $errorField == 'date'} class="formError"{/if}>
			<dt><label for="date">{lang}wcf.global.date{/lang}</label></dt>
			<dd>
				<input type="date" id="date" name="date" value="{$date}" class="small" required />
			</dd>
		</dl>

		<dl>
			<dt></dt>
			<dd>
				<label><input type="checkbox" id="isHighlight" name="isHighlight" value="1"{if $isHighlight} checked{/if}>{lang}wcf.global.isHighlight{/lang}</label>
			</dd>
		</dl>

		<dl{if $errorField == 'text'} class="formError"{/if}>
			<dt><label for="timelineContent">{lang}wcf.acp.page.content{/lang}</label></dt>
			<dd>
				<textarea name="text" id="text" class="wysiwygTextarea" data-disable-attachments="true" data-autosave="de.fabihome.wsc.timeline{if $action == 'edit'}.{$timeline->timelineID}{/if}.{$action|ucfirst}">{$text}</textarea>
				{include file='wysiwyg' wysiwygSelector='text'}

				{if $errorField == 'text'}
					<small class="innerError">
						{if $errorType == 'empty'}
							{lang}wcf.global.form.error.empty{/lang}
						{else}
							{lang}wcf.acp.page.content.error.{@$errorType}{/lang}
						{/if}
					</small>
				{/if}
			</dd>
		</dl>

		{event name='dataFields'}
	</div>

	{event name='sections'}

	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s">
		{@SECURITY_TOKEN_INPUT_TAG}
	</div>
</form>

{include file='footer'}
