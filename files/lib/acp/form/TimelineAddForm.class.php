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
	 * iconName value
	 *
	 * @var        string
	 */
	public $iconName = 'star';

	/**
	 * iconColor value
	 *
	 * @var        string
	 */
	public $iconColor = 'rgba(255, 235, 59, 1)';

	/**
	 * badgeColor value
	 *
	 * @var        string
	 */
	public $badgeColor = 'rgba(255, 255, 255, 0)';
	
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
		
		if (isset($_POST['iconName'])) $this->iconName = StringUtil::trim($_POST['iconName']);
		if (isset($_POST['iconColor'])) $this->iconColor = StringUtil::trim($_POST['iconColor']);
		if (isset($_POST['badgeColor'])) $this->badgeColor = StringUtil::trim($_POST['badgeColor']);
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
		
		// reset values
		$this->subject = $this->iconName = $this->iconColor = $this->badgeColor = $this->date = $this->text = '';
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
			'iconName' => $this->iconName,
			'iconColor' => $this->iconColor,
			'badgeColor' => $this->badgeColor,
			'date' => $this->date,
			'isHighlight' => $this->isHighlight,
		]);
	}
}
