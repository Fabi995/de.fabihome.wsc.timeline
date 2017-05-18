<?php

namespace wcf\data\timeline;

use wcf\data\AbstractDatabaseObjectAction;

/**
 * Database Action Class
 *
 * @author           Fabian Graf
 * @copyright        2017 Fabian Graf
 * @license          GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
class TimelineAction extends AbstractDatabaseObjectAction {
	/**
	 * @inheritDoc
	 */
	protected $permissionsDelete = array('admin.content.timeline.canManageTimeline');
	
	/**
	 * @inheritDoc
	 */
	protected $permissionsUpdate = array('admin.content.timeline.canManageTimeline');
	
	/**
	 * @inheritDoc
	 */
	protected $requireACP = array('delete', 'getSearchResultList', 'update');
	
}
