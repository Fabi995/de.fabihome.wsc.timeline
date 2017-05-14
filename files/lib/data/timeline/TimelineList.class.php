<?php
namespace wcf\data\timeline;
use wcf\data\DatabaseObjectList;

/**
 * Database List Class
 *
 * @author	Fabian Graf
 * @copyright	2017 Fabian Graf
 * @license	All rights reserved
 */

class TimelineList extends DatabaseObjectList
{
    /**
     * @inheritDoc
     */
    protected static $baseClass = Timeline::class;
}