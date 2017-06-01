<?php

namespace wcf\acp\form;

use wcf\data\timeline\TimelineAction;
use wcf\form\MessageForm;
use wcf\system\exception\UserInputException;
use wcf\system\html\input\HtmlInputProcessor;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the timeline add form.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          All rights reserved
 */
class TimelineAddForm extends MessageForm {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.timeline.add';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['admin.content.timeline.canManageTimeline'];
	
	/**
	 * @inheritDoc
	 */
	public $messageObjectType = 'de.fabihome.wsc.timeline.content';
	
	/**
	 * @inheritDoc
	 */
	public $action = 'add';
	
	/**
	 * icon value
	 *
	 * @var        string
	 */
	public $icon = '';
	
	/**
	 * date value
	 *
	 * @var        string
	 */
	public $date = '';
	
	/**
	 * timline date object
	 *
	 * @var        \DateTime
	 */
	public $timeObj;
	
	/**
	 * @var HtmlInputProcessor
	 */
	public $htmlInputProcessor;
	
	/**
	 * isHighlight value
	 *
	 * @var        string
	 */
	public $isHighlight = 0;
	
	/**
	 * @inheritDoc
	 */
	public function readFormParameters() {
		parent::readFormParameters();
		
		if (isset($_POST['icon'])) $this->icon = StringUtil::trim($_POST['icon']);
		if (isset($_POST['date'])) {
			$this->date = $_POST['date'];
			$this->timeObj = \DateTime::createFromFormat('Y-m-d', $this->date);
		}
		if (isset($_POST['isHighlight'])) $this->isHighlight = intval($_POST['isHighlight']);
	}
	
	/**
	 * @inheritDoc
	 */
	public function validate() {
		parent::validate();
		
		// timeline date
		if (empty($this->date)) {
			throw new UserInputException('date');
		}
		if (!$this->timeObj) {
			throw new UserInputException('date', 'invalid');
		}
	}
	
	/**
	 * @inheritDoc
	 */
	public function save() {
		parent::save();
		
		// save timeline
		$this->objectAction = new TimelineAction([], 'create', [
			'data' => array_merge($this->additionalFields, [
				'title' => $this->subject,
				'icon' => $this->icon,
				'date' => $this->timeObj->getTimestamp(),
				'content' => $this->text,
				'isHighlight' => $this->isHighlight
			]),
			'htmlInputProcessor' => $this->htmlInputProcessor
		]);
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// reset values
		$this->subject = $this->icon = $this->date = $this->text = '';
		$this->isHighlight = 0;
		
		// show success message
		WCF::getTPL()->assign('success', true);
	}
	
	/**
	 * @inheritDoc
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		WCF::getTPL()->assign([
			'icon' => $this->icon,
			'date' => $this->date,
			'isHighlight' => $this->isHighlight,
		]);
	}
}
