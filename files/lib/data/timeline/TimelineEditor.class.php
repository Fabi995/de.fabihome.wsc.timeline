<?php
namespace wcf\data\timeline;
use wcf\data\DatabaseObjectEditor;

/**
 * Database Editor Class
 *
 * @author	Fabian Graf
 * @copyright	2017 Fabian Graf
 * @license	All rights reserved
 */

class TimelineEditor extends DatabaseObjectEditor
{
    /**
     * @inheritDoc
     */
    protected static $baseClass = Timeline::class;
}