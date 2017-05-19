<?php

namespace wcf\acp\form;

use wcf\data\timeline\TimelineAction;
use wcf\form\MessageForm;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Shows the timeline add form.
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
class TimelineAddForm extends MessageForm {
	/**
	 * available icons
	 *
	 * @var        array<string>
	 */
	public static $availableIcons = array(
		'none', 'adjust', 'adn', 'align-center', 'align-justify', 'align-left', 'align-right', 'ambulance', 'anchor', 'android', 'angle-down', 'angle-left', 'angle-right', 'angle-up', 'apple', 'archive', 'arrow-down', 'arrow-left', 'arrow-right', 'arrow-up', 'asterisk', 'backward', 'ban-circle', 'bar-chart', 'barcode', 'beaker', 'beer', 'bell', 'bell-alt', 'bitbucket', 'bitbucket-sign', 'bitcoin', 'bold', 'bolt', 'book', 'bookmark', 'bookmark-empty', 'briefcase', 'bug', 'building', 'bullhorn', 'bullseye', 'calendar', 'calendar-empty', 'camera', 'camera-retro', 'caret-down', 'caret-left', 'caret-right', 'caret-up', 'certificate', 'check', 'check-minus', 'check-sign', 'chevron-down', 'chevron-left', 'chevron-right', 'chevron-sign-down', 'chevron-sign-left', 'chevron-sign-right', 'chevron-sign-up', 'chevron-up', 'circle', 'circle-arrow-down', 'circle-arrow-left', 'circle-arrow-right', 'circle-arrow-up', 'circle-blank', 'cloud', 'cloud-download', 'cloud-upload', 'code',
		'code-fork', 'coffee', 'collapse', 'collapse-alt', 'collapse-top', 'columns', 'comment', 'comment-alt', 'comments', 'comments-alt', 'compass', 'copy', 'credit-card', 'crop', 'css3', 'cut', 'dashboard', 'desktop', 'dollar', 'double-angle-down', 'double-angle-left', 'double-angle-right', 'double-angle-up', 'download', 'download-alt', 'dribbble', 'dropbox', 'edit', 'edit-sign', 'eject', 'ellipsis-horizontal', 'ellipsis-vertical', 'envelope', 'envelope-alt', 'eraser', 'euro', 'exchange', 'exclamation', 'exclamation-sign', 'expand', 'expand-alt', 'external-link', 'external-link-sign', 'eye-close', 'eye-open', 'facebook', 'facebook-sign', 'facetime-video', 'fast-backward', 'fast-forward', 'female', 'fighter-jet', 'file', 'file-alt', 'file-text', 'file-text-alt', 'film', 'filter', 'fire', 'fire-extinguisher', 'flag', 'flag-alt', 'flag-checkered', 'flickr', 'folder-close', 'folder-close-alt', 'folder-open', 'folder-open-alt', 'font', 'food', 'forward', 'foursquare', 'frown',
		'fullscreen', 'gamepad', 'gbp', 'gear', 'gears', 'gift', 'github', 'github-alt', 'github-sign', 'gittip', 'glass', 'globe', 'google-plus', 'google-plus-sign', 'group', 'hand-down', 'hand-left', 'hand-right', 'hand-up', 'hdd', 'headphones', 'heart', 'heart-empty', 'home', 'hospital', 'h-sign', 'html5', 'inbox', 'indent-left', 'indent-right', 'info', 'info-sign', 'instagram', 'italic', 'key', 'keyboard', 'laptop', 'leaf', 'legal', 'lemon', 'level-down', 'level-up', 'lightbulb', 'link', 'linkedin', 'linkedin-sign', 'linux', 'list', 'list-alt', 'list-ol', 'list-ul', 'location-arrow', 'lock', 'long-arrow-down', 'long-arrow-left', 'long-arrow-right', 'long-arrow-up', 'magic', 'magnet', 'mail-forward', 'mail-reply', 'male', 'map-marker', 'maxcdn', 'medkit', 'meh', 'microphone', 'microphone-off', 'minus', 'minus-sign', 'minus-sign-alt', 'mobile-phone', 'money', 'moon', 'move', 'music', 'ok', 'ok-circle', 'ok-sign', 'paperclip', 'paste', 'pause', 'pencil', 'phone', 'phone-sign',
		'picture', 'pinterest', 'pinterest-sign', 'plane', 'play', 'play-circle', 'play-sign', 'plus', 'plus-sign', 'plus-sign-alt', 'power-off', 'print', 'pushpin', 'puzzle-piece', 'qrcode', 'question', 'question-sign', 'quote-left', 'quote-right', 'random', 'refresh', 'remove', 'remove-circle', 'remove-sign', 'renminbi', 'renren', 'reorder', 'reply-all', 'resize-full', 'resize-horizontal', 'resize-small', 'resize-vertical', 'retweet', 'road', 'rocket', 'rotate-left', 'rotate-right', 'rss', 'rss-sign', 'rupee', 'save', 'screenshot', 'search', 'share', 'share-sign', 'shield', 'shopping-cart', 'signal', 'sign-blank', 'signin', 'signout', 'sitemap', 'skype', 'smile', 'sort', 'sort-by-alphabet', 'sort-by-alphabet-alt', 'sort-by-attributes', 'sort-by-attributes-alt', 'sort-by-order', 'sort-by-order-alt', 'sort-down', 'sort-up', 'spinner', 'stackexchange', 'star', 'star-empty', 'star-half', 'star-half-full', 'step-backward', 'step-forward', 'stethoscope', 'stop', 'strikethrough',
		'subscript', 'suitcase', 'sun', 'superscript', 'table', 'tablet', 'tag', 'tags', 'tasks', 'terminal', 'text-height', 'text-width', 'th', 'th-large', 'th-list', 'thumbs-down', 'thumbs-down-alt', 'thumbs-up', 'thumbs-up-alt', 'ticket', 'time', 'tint', 'trash', 'trello', 'trophy', 'truck', 'tumblr', 'tumblr-sign', 'twitter', 'twitter-sign', 'umbrella', 'unchecked', 'underline', 'unlink', 'unlock', 'unlock-alt', 'upload', 'upload-alt', 'user', 'user-md', 'vk', 'volume-down', 'volume-off', 'volume-up', 'warning-sign', 'weibo', 'windows', 'won', 'wrench', 'xing', 'xing-sign', 'yen', 'youtube', 'youtube-play', 'youtube-sign', 'zoom-in', 'zoom-out'
	);
	
	/**
	 * @inheritDoc
	 */
	public $activeMenuItem = 'wcf.acp.menu.link.timeline.add';
	
	/**
	 * @inheritDoc
	 */
	public $neededPermissions = array('admin.content.timeline.canManageTimeline');
	
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
		$this->objectAction = new TimelineAction(array(), 'create', array(
			'data' => array_merge($this->additionalFields, array(
				'title' => $this->subject,
				'icon' => $this->icon,
				'date' => $this->timeObj->getTimestamp(),
				'content' => $this->text,
				'isHighlight' => $this->isHighlight,
			))
		));
		
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
		
		WCF::getTPL()->assign(array(
			'action' => 'add',
			'icon' => $this->icon,
			'date' => $this->date,
			'isHighlight' => $this->isHighlight,
			'availableIcons' => self::$availableIcons
		));
	}
}
