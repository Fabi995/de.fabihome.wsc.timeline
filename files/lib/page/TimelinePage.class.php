<?php

namespace wcf\page;

use wcf\data\timeline\TimelineList;

/**
 * Shows the timeline page.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          All rights reserved
 */
class TimelinePage extends SortablePage {
	
	/**
	 * @inheritDoc
	 */
	public $defaultSortField = 'date';
	
	/**
	 * @inheritDoc
	 */
	public $sortOrder = TIMELINE_DEFAULT_SORT_ORDER;
	
	/**
	 * @inheritDoc
	 */
	public $itemsPerPage = TIMELINE_LIST_ENTRIES_PER_PAGE;
	
	/**
	 * @inheritDoc
	 */
	public $objectListClassName = TimelineList::class;
	
}
