<?php

namespace wcf\data\timeline;

use wcf\data\DatabaseObjectEditor;

/**
 * Database Editor Class
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
class TimelineEditor extends DatabaseObjectEditor {
	/**
	 * @inheritDoc
	 */
	protected static $baseClass = 'wcf\\data\\timeline\\Timeline';
}
