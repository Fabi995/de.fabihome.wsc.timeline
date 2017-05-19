{include file='header' pageTitle='wcf.acp.timeline.'|concat:$action}

<script data-relocate="true">
	//<![CDATA[
	$(function () {
		WCF.TabMenu.init();

		var sel = document.getElementById('icon');
		var show = document.getElementById('show');
		sel.addEventListener('change', function () {
			show.innerHTML = '<span class="icon icon32 icon-' + this.value + '"></span>'
		});
	});
	//]]>
</script>

<header class="boxHeadline">
	<h1>{lang}wcf.acp.timeline.{$action}{/lang}</h1>
</header>

{include file='formError'}

{if $success|isset}
	<p class="success">{lang}wcf.global.success.{$action}{/lang}</p>
{/if}

<div class="contentNavigation">
	<nav>
		<ul>
			<li><a href="{link controller='TimelineList'}{/link}" class="button"><span class="icon icon16 icon-list"></span> <span>{lang}wcf.acp.menu.link.timeline.list{/lang}</span></a></li>

			{event name='contentNavigationButtons'}
		</ul>
	</nav>
</div>

<form method="post" action="{if $action == 'add'}{link controller='TimelineAdd'}{/link}{else}{link controller='TimelineEdit' id=$timeline->timelineID}{/link}{/if}">
	<div class="container containerPadding marginTop">
		<fieldset>
			<dl{if $errorField == 'subject'} class="formError"{/if}>
				<dt><label for="subject">{lang}wcf.global.title{/lang}</label></dt>
				<dd>
					<input type="text" id="subject" name="subject" value="{$subject}" required autofocus class="long">
					{if $errorField == 'subject'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{elseif $errorType == 'censoredWordsFound'}
								{lang}wcf.message.error.censoredWordsFound{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>

			<dl{if $errorField == 'icon'} class="formError"{/if}>
				<dt><label for="icon">{lang}wcf.global.icon{/lang}</label></dt>
				<dd>
					<select name="icon" id="icon">
						{foreach from=$availableIcons item=availableIcons}
							<option value="{$availableIcons}" {if $availableIcons == $icon}selected="selected"{/if}>{$availableIcons}</option>
						{/foreach}
					</select> <span id="show"></span>
				</dd>
			</dl>

			<dl{if $errorField == 'date'} class="formError"{/if}>
				<dt><label for="date">{lang}wcf.global.date{/lang}</label></dt>
				<dd>
					<input type="date" id="date" name="date" value="{$date}" class="small" required="required" />
				</dd>
			</dl>

			<dl>
				<dt></dt>
				<dd>
					<label><input type="checkbox" id="isHighlight" name="isHighlight" value="1"{if $isHighlight} checked{/if}>{lang}wcf.global.isHighlight{/lang}</label>
				</dd>
			</dl>

			<dl{if $errorField == 'text'} class="formError"{/if}>
				<dt><label for="text">{lang}wcf.acp.timeline.content{/lang}</label></dt>
				<dd>
					<textarea name="text" id="text" class="wysiwygTextarea" data-disable-attachments="true" data-autosave="de.fabihome.wsc.timeline{if $action == 'edit'}.{$timeline->timelineID}{/if}.{$action|ucfirst}">{$text}</textarea>
					{include file='wysiwyg' wysiwygSelector='text'}

					{if $errorField == 'text'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{elseif $errorType == 'tooLong'}
								{lang}wcf.message.error.tooLong{/lang}
							{elseif $errorType == 'censoredWordsFound'}
								{lang}wcf.message.error.censoredWordsFound{/lang}
							{elseif $errorType == 'disallowedBBCodes'}
								{lang}wcf.message.error.disallowedBBCodes{/lang}
							{else}
								{lang}wcf.acp.page.content.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>
		</fieldset>

	</div>

	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s">
		{@SECURITY_TOKEN_INPUT_TAG}
	</div>
</form>

{include file='footer'}
