<?php

namespace wcf\acp\form;

use wcf\data\timeline\Timeline;
use wcf\data\timeline\TimelineAction;
use wcf\form\MessageForm;
use wcf\system\exception\IllegalLinkException;
use wcf\system\WCF;
use wcf\util\DateUtil;

/**
 * Shows the timeline edit form.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          All rights reserved
 */
class TimelineEditForm extends TimelineAddForm {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.timeline';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['admin.content.timeline.canManageTimeline'];
	
	/**
	 * @inheritDoc
	 */
	public $action = 'edit';
	
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
		MessageForm::save();
		
		// update timeline
		$this->objectAction = new TimelineAction([$this->timelineID], 'update', [
			'data' => array_merge($this->additionalFields, [
				'title' => $this->subject,
				'iconName' => $this->iconName,
				'iconColor' => $this->iconColor,
				'badgeColor' => $this->badgeColor,
				'date' => $this->timeObj->getTimestamp(),
				'content' => $this->text,
				'isHighlight' => $this->isHighlight
			]),
			'htmlInputProcessor' => $this->htmlInputProcessor
		]);
		
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
			$this->subject = $this->timelineObj->title;
			$this->iconName = $this->timelineObj->iconName;
			$this->iconColor = $this->timelineObj->iconColor;
			$this->badgeColor = $this->timelineObj->badgeColor;
			$dateTime = DateUtil::getDateTimeByTimestamp($this->timelineObj->date);
			$dateTime->setTimezone(WCF::getUser()->getTimeZone());
			$this->date = $dateTime->format('c');
			$this->text = $this->timelineObj->content;
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
		
		WCF::getTPL()->assign([
			'timeline' => $this->timelineObj
		]);
	}
}
