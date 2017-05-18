<?php

namespace wcf\acp\page;

use wcf\page\SortablePage;

/**
 * Shows a list of timeline.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
class TimelineListPage extends SortablePage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.timeline.list';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = array('admin.content.timeline.canManageTimeline');
	
	/**
	 * @inheritDoc
	 */
	public $defaultSortField = 'timelineID';
	
	/**
	 * @inheritDoc
	 */
	public $validSortFields = array('timelineID', 'title', 'date');
	
	/**
	 * @inheritDoc
	 */
	public $objectListClassName = 'wcf\\data\\timeline\\TimelineList';
	
}
