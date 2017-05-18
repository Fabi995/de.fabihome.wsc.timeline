<?php
namespace wcf\data\timeline;
use wcf\data\DatabaseObject;
use wcf\system\html\output\HtmlOutputProcessor;
use wcf\system\message\embedded\object\MessageEmbeddedObjectManager;
use wcf\system\WCF;

/**
 * Database Main Class
 *
 * @author	Fabian Graf
 * @copyright	2017 Fabian Graf
 * @license	All rights reserved
 *
 * @property-read integer $timelineID
 * @property-read string  $title
 * @property-read string  $content
 * @property-read string  $icon
 * @property-read integer $date
 * @property-read integer $isHighlight
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
    public function getFormattedContent() {
        $processor = new HtmlOutputProcessor();

        if ($this->hasEmbeddedObjects) {
            MessageEmbeddedObjectManager::getInstance()->loadObjects('de.fabihome.wsc.timeline.content', [$this->timelineID]);
        }

        $processor->process($this->content, 'de.fabihome.wsc.timeline.content', $this->timelineID);

        return $processor->getHtml();
    }

    /**
     * Returns true if the active user can delete this timeline.
     *
     * @return	boolean
     */
    public function canDelete() {
        if (WCF::getSession()->getPermission('admin.content.timeline.canManageTimeline')) {
            return true;
        }

        return false;
    }
}