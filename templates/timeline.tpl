{include file='header'}

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
						{@$timeline->getFormattedContent()}
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

<footer class="contentFooter">

	{hascontent}
		<div class="paginationBottom">
			{content}{pages print=true assign=pagesLinks controller="Timeline" link="pageNo=%d"}{/content}
		</div>
	{/hascontent}

	{hascontent}
		<nav class="contentFooterNavigation">
			<ul>
				{content}{event name='contentFooterNavigation'}{/content}
			</ul>
		</nav>
	{/hascontent}
</footer>

{include file='footer'}
