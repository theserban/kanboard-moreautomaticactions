<?php

namespace Kanboard\Plugin\MoreAutomaticActions\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;

/**
 * Rename Task Title
 *
 * @package action
 * @author  Serban Alexandru
 */
class MoveToProjectCategory extends Base
{
    /**
     * Get automatic action description
     *
    * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('M.A.A: Keep category when moving to project');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_MOVE_COLUMN,
            TaskModel::EVENT_CLOSE,
            TaskModel::EVENT_CREATE,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            'column_id' => t('Column'),
            'project_id' => t('Project'),
            'swimlane_id' => t('Swimlane'),
            'category_id' => t('Category'),
        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            'task' => array(
                'project_id',
                'column_id',
                'swimlane_id',
            )
        );
    }

    /**
     * Execute the action (duplicate the task to another project)
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $destination_column_id = $this->columnModel->getFirstColumnId($this->getParam('project_id'));
        return (bool) $this->taskProjectDuplicationModel->duplicateToProject(
            $data['task_id'],
            $this->getParam('project_id'),
            null,
            $destination_column_id,
            $values['category_id'],
        );
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return $data['task']['column_id'] == $this->getParam('column_id') && $data['task']['project_id'] != $this->getParam('project_id');
    }
}
