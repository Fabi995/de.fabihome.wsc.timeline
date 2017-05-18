<?php

namespace wcf\data\timeline;

use wcf\data\DatabaseObject;
use wcf\system\bbcode\MessageParser;

/**
 * Database Main Class
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
class Timeline extends DatabaseObject {
	/**
	 * @inheritDoc
	 */
	protected static $databaseTableName = 'timeline';
	
	/**
	 * @inheritDoc
	 */
	protected static $databaseTableIndexName = 'timelineID';
	
	/**
	 * Returns the timeline's formatted content.
	 *
	 * @return      string
	 */
	public function getFormattedMessage() {
		// parse and return message
		MessageParser::getInstance()->setOutputType('text/html');
		
		return MessageParser::getInstance()->parse($this->content, 1, 0, 1);
	}
}
