<?php

namespace wcf\acp\form;

use wcf\data\timeline\Timeline;
use wcf\data\timeline\TimelineAction;
use wcf\form\AbstractForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;
use wcf\util\DateUtil;

/**
 * Shows the timeline edit form.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
class TimelineEditForm extends TimelineAddForm {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.timeline';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = array('admin.content.timeline.canManageTimeline');
	
	/**
	 * timeline id
	 *
	 * @var        integer
	 */
	public $timelineID = 0;
	
	/**
	 * timeline object
	 *
	 * @var        Timeline
	 */
	public $timelineObj = null;
	
	/**
	 * @inheritDoc
	 */
	public function readParameters() {
		parent::readParameters();
		
		if (isset($_REQUEST['id'])) $this->timelineID = intval($_REQUEST['id']);
		$this->timelineObj = new Timeline($this->timelineID);
		if (!$this->timelineObj->timelineID) {
			throw new IllegalLinkException();
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function save() {
		AbstractForm::save();
		
		// update timeline
		$this->objectAction = new TimelineAction(array($this->timelineID), 'update', array(
			'data' => array_merge($this->additionalFields, array(
				'title' => $this->title,
				'icon' => $this->icon,
				'date' => $this->timeObj->getTimestamp(),
				'content' => $this->content,
				'isHighlight' => $this->isHighlight,
			
			))
		));
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
	
	/**
	 * @inheritDoc
	 */
	public function readData() {
		parent::readData();
		
		if (empty($_POST)) {
			$this->title = $this->timelineObj->title;
			$this->icon = $this->timelineObj->icon;
			$dateTime = DateUtil::getDateTimeByTimestamp($this->timelineObj->date);
			$dateTime->setTimezone(WCF::getUser()->getTimeZone());
			$this->date = $dateTime->format('c');
			$this->content = $this->timelineObj->content;
			if ($this->timelineObj->isHighlight) {
				$this->isHighlight = 1;
			}
			else $this->isHighlight = 0;
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign(array(
			'timeline' => $this->timelineObj,
			'action' => 'edit'
		));
	}
}
