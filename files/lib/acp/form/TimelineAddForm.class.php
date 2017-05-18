<?php

namespace wcf\acp\form;

use wcf\data\timeline\TimelineAction;
use wcf\form\AbstractForm;
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
class TimelineAddForm extends AbstractForm {
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.timeline.add';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = ['admin.content.timeline.canManageTimeline'];
	
	/**
	 * title value
	 *
	 * @var        string
	 */
	public $title = '';
	
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
	 * content value
	 *
	 * @var        string
	 */
	public $content = '';
	
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
		
		if (isset($_POST['title'])) $this->title = StringUtil::trim($_POST['title']);
		if (isset($_POST['icon'])) $this->icon = StringUtil::trim($_POST['icon']);
		if (isset($_POST['date'])) {
			$this->date = $_POST['date'];
			$this->timeObj = \DateTime::createFromFormat('Y-m-d', $this->date);
		}
		if (isset($_POST['timelineContent'])) $this->content = StringUtil::trim($_POST['timelineContent']);
		if (isset($_POST['isHighlight'])) $this->isHighlight = intval($_POST['isHighlight']);
	}
	
	/**
	 * @inheritDoc
	 */
	public function validate() {
		parent::validate();
		
		if (empty($this->title)) {
			throw new UserInputException('title');
		}
		
		// timeline date
		if (empty($this->date)) {
			throw new UserInputException('date');
		}
		if (!$this->timeObj) {
			throw new UserInputException('date', 'invalid');
		}
		
		// content
		if (empty($this->content)) {
			throw new UserInputException('content');
		}
		
		$this->htmlInputProcessor = new HtmlInputProcessor();
		$this->htmlInputProcessor->process($this->content, 'de.fabihome.wsc.timeline.content', 0);
	}
	
	/**
	 * @inheritDoc
	 */
	public function save() {
		parent::save();
		
		// save timeline
		$this->objectAction = new TimelineAction([], 'create', [
			'data' => array_merge($this->additionalFields, [
				'title' => $this->title,
				'icon' => $this->icon,
				'date' => $this->timeObj->getTimestamp(),
				'content' => $this->htmlInputProcessor->getHtml(),
				'isHighlight' => $this->isHighlight,
			]),
			'htmlInputProcessor' => $this->htmlInputProcessor
		]);
		
		$this->objectAction->executeAction();
		
		$this->saved();
		
		// reset values
		$this->title = '';
		$this->icon = '';
		$this->date = '';
		$this->content = '';
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
			'action' => 'add',
			'title' => $this->title,
			'icon' => $this->icon,
			'date' => $this->date,
			'content' => $this->content,
			'isHighlight' => $this->isHighlight,
		]);
	}
}
