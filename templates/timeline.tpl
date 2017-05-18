{include file='documentHeader'}

<head>
	<title>{lang}wcf.user.timeline.headline{/lang}</title>
	<link rel="canonical" href="{link controller='Timeline'}{/link}" />
	{include file='headInclude'}
</head>

{include file='header'}

<body id="tpl_{$templateNameApplication}_{$templateName}" data-template="{$templateName}" data-application="{$templateNameApplication}">

<div class="timelineContainer">
	{foreach from=$objects item=timeline}
		<div id="timeline-entry{$timeline->timelineID}" class="timeline{if $timeline->isHighlight} highlighted{/if}">

			<div class="timeline-date">
				{$timeline->date|date:TIMELINE_DEFAULT_DATE_FORMAT}
			</div>

			<div class="timeline-icon">
				<span class="icon icon48 fa-{if $timeline->icon}{$timeline->icon}{else}star{/if}"></span>
			</div>

			<div class="timeline-content-container">
				<div class="timeline-content">

					<div class="timeline-title">
						{$timeline->title}
						{if $timeline->isHighlight}<span class="icon icon32 fa-bookmark"></span>{/if}
					</div>

					<div class="timeline-text">
						{@$timeline->getFormattedMessage()}
					</div>

				</div>
			</div>
		</div>
	{/foreach}
</div>

<script data-relocate="true">
	(function () {
		var $timeline = $('.timeline');

		//hide timeline blocks which are outside the viewport
		$timeline.each(function () {
			if ($(this).offset().top > $(window).scrollTop() + $(window).height() * 0.75) {
				$(this).find('.timeline-icon, .timeline-content-container, .timeline-date').addClass('hidden');
			}
		});

		//on scolling, show/animate timeline blocks when enter the viewport
		$(window).on('scroll', function () {
			$timeline.each(function () {
				if ($(this).offset().top <= $(window).scrollTop() + $(window).height() * 0.75 && $(this).find('.timeline-icon').hasClass('hidden')) {
					$(this).find('.timeline-icon, .timeline-content-container, .timeline-date').removeClass('hidden').addClass('slide-in-up');
				}
			});
		});
	})();
</script>

<div class="contentNavigation">
	{pages print=true assign=pagesLinks controller="Timeline" link="pageNo=%d"}

	{hascontent}
		<nav class="contentFooterNavigation">
			<ul>
				{content}{event name='contentFooterNavigation'}{/content}
			</ul>
		</nav>
	{/hascontent}
</div>

{include file='footer'}

</body>
</html>
