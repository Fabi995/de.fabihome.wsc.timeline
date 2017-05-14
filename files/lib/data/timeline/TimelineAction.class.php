<?php
namespace wcf\data\timeline;
use wcf\data\AbstractDatabaseObjectAction;
use wcf\system\database\util\PreparedStatementConditionBuilder;
use wcf\system\exception\UserInputException;
use wcf\system\WCF;

/**
 * Database Action Class
 *
 * @author	Fabian Graf
 * @copyright	2017 Fabian Graf
 * @license	All rights reserved
 */

class TimelineAction extends AbstractDatabaseObjectAction{

    /**
     * @inheritDoc
     */
    protected $className = TimelineEditor::class;

    /**
     * @inheritDoc
     */
    protected $permissionsDelete = ['admin.content.timeline.canManageTimeline'];

    /**
     * @inheritDoc
     */
    protected $permissionsUpdate = ['admin.content.timeline.canManageTimeline'];


    /**
     * @inheritDoc
     */
    protected $requireACP = ['delete', 'getSearchResultList', 'search', 'update'];

    /**
     * @inheritDoc
     */
    public function validateGetSearchResultList() {
        $this->readString('searchString', false, 'data');

        if (isset($this->parameters['data']['excludedSearchValues']) && !is_array($this->parameters['data']['excludedSearchValues'])) {
            throw new UserInputException('excludedSearchValues');
        }
    }

    /**
     * @inheritDoc
     */
    public function getSearchResultList() {
        $excludedSearchValues = [];
        if (isset($this->parameters['data']['excludedSearchValues'])) {
            $excludedSearchValues = $this->parameters['data']['excludedSearchValues'];
        }
        $list = [];

        $conditionBuilder = new PreparedStatementConditionBuilder();
        $conditionBuilder->add("name LIKE ?", [$this->parameters['data']['searchString'].'%']);
        if (!empty($excludedSearchValues)) {
            $conditionBuilder->add("name NOT IN (?)", [$excludedSearchValues]);
        }

        // find entry
        $sql = "SELECT	timelineID, name
			FROM	wcf".WCF_N."_timeline
			".$conditionBuilder;
        $statement = WCF::getDB()->prepareStatement($sql, 5);
        $statement->execute($conditionBuilder->getParameters());
        while ($row = $statement->fetchArray()) {
            $list[] = [
                'label' => $row['title'],
                'objectID' => $row['timelineID']
            ];
        }

        return $list;
    }
}