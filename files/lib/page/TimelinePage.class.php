<?php

namespace wcf\page;

/**
 * Shows the timeline page.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
class TimelinePage extends SortablePage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.user.timeline';
	
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
	public $objectListClassName = 'wcf\\data\\timeline\\TimelineList';
	
}
