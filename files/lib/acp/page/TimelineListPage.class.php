<?php

namespace wcf\acp\page;

use wcf\data\timeline\TimelineList;
use wcf\page\SortablePage;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows a list of timeline.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          All rights reserved
 */
class TimelineListPage extends SortablePage {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.timeline.list';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['admin.content.timeline.canManageTimeline'];
	
	/**
	 * @inheritDoc
	 */
	public $defaultSortField = 'timelineID';
	
	/**
	 * @inheritDoc
	 */
	public $validSortFields = ['timelineID', 'title', 'date'];
	
	/**
	 * @inheritDoc
	 */
	public $objectListClassName = TimelineList::class;
	
	/**
	 * search-query
	 *
	 * @var        string
	 */
	public $search = '';
	
	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign([
			'search' => $this->search
		]);
	}
	
	/**
	 * @inheritDoc
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['search'])) $this->search = StringUtil::trim($_REQUEST['search']);
	}
	
	/**
	 * @inheritDoc
	 */
	protected function initObjectList() {
		parent::initObjectList();
		
		if ($this->search !== '') {
			$this->objectList->getConditionBuilder()->add('timeline.title LIKE ?', [$this->search . '%']);
		}
	}
}
