{include file='header' pageTitle='wcf.acp.timeline.'|concat:$action}

{js application='wcf' file='WCF.ColorPicker' bundle='WCF.Combined'}
{include file='fontAwesomeJavaScript'}

<script data-relocate="true">
	require(['Language', 'WoltLabSuite/Core/Acp/Ui/Trophy/Badge'], function (Language, BadgeHandler) {
		Language.addObject({
			'wcf.style.colorPicker': '{lang}wcf.style.colorPicker{/lang}',
			'wcf.style.colorPicker.new': '{lang}wcf.style.colorPicker.new{/lang}',
			'wcf.style.colorPicker.current': '{lang}wcf.style.colorPicker.current{/lang}',
			'wcf.style.colorPicker.button.apply': '{lang}wcf.style.colorPicker.button.apply{/lang}',
			'wcf.acp.style.image.error.invalidExtension': '{lang}wcf.acp.style.image.error.invalidExtension{/lang}',
			'wcf.acp.trophy.badge.edit': '{lang}wcf.acp.trophy.badge.edit{/lang}',
		});

		BadgeHandler.init();
	});
</script>

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

		<dl id="badgeContainer">
			<dt>{lang}wcf.acp.trophy.type.badge{/lang}</dt>
			<dd>
				<span class="icon icon64 fa-{$iconName} jsTrophyIcon trophyIcon" style="color: {$iconColor}; background-color: {$badgeColor}"></span>
				<button class="small">{lang}wcf.global.button.edit{/lang}</button>

				<input type="hidden" name="iconName" value="{$iconName}">
				<input type="hidden" name="iconColor" value="{$iconColor}">
				<input type="hidden" name="badgeColor" value="{$badgeColor}">
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

<div id="trophyIconEditor" style="display: none;">
	<div class="box128">
		<span class="icon icon144 fa-{$iconName} jsTrophyIcon trophyIcon" style="color: {$iconColor}; background-color: {$badgeColor}"></span>
		<div>
			<dl>
				<dt>{lang}wcf.acp.trophy.badge.iconName{/lang}</dt>
				<dd>
					<span class="jsTrophyIconName">{$iconName}</span>
					<a href="#" class="button small"><span class="icon icon16 fa-search"></span></a>
				</dd>
			</dl>

			<dl id="jsIconColorContainer">
				<dt>{lang}wcf.acp.trophy.badge.iconColor{/lang}</dt>
				<dd>
					<span class="colorBox">
						<span id="iconColorValue" class="colorBoxValue jsColorPicker" data-store="iconColorValue"></span>
						<input type="hidden" id="iconColorValue">
					</span>
					<a href="#" class="button small jsButtonIconColorPicker"><span class="icon icon16 fa-paint-brush"></span></a>
				</dd>
			</dl>

			<dl id="jsBadgeColorContainer">
				<dt>{lang}wcf.acp.trophy.badge.badgeColor{/lang}</dt>
				<dd>
					<span class="colorBox">
						<span id="badgeColorValue" class="colorBoxValue jsColorPicker" data-store="badgeColorValue"></span>
						<input type="hidden" id="badgeColorValue">
					</span>
					<a href="#" id="test" class="button small jsButtonBadgeColorPicker"><span class="icon icon16 fa-paint-brush"></span></a>
				</dd>
			</dl>
		</div>
	</div>

	<div class="formSubmit">
		<button class="buttonPrimary">{lang}wcf.global.button.save{/lang}</button>
	</div>
</div>

{include file='footer'}
