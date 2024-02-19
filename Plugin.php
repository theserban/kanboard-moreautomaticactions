<?php

namespace Kanboard\Plugin\MoreAutomaticActions;

use Kanboard\Core\Plugin\Base;

use Kanboard\Plugin\MoreAutomaticActions\Action\TaskClose;
use Kanboard\Plugin\MoreAutomaticActions\Action\TaskOpen;
use Kanboard\Plugin\MoreAutomaticActions\Action\TaskMoveSpecificSwimlane;
use Kanboard\Plugin\MoreAutomaticActions\Action\MoveToProjectCategory;
use Kanboard\Plugin\MoreAutomaticActions\Action\ChangeCategoryCreation;
use Kanboard\Plugin\MoreAutomaticActions\Action\TaskRename;
use Kanboard\Plugin\MoreAutomaticActions\Action\TaskMoveColumnOpen;
use Kanboard\Plugin\MoreAutomaticActions\Action\TaskMoveColumnClose;
use Kanboard\Plugin\MoreAutomaticActions\Action\ChangeAssigneeCreation;

class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->register(new TaskClose($this->container));
        $this->actionManager->register(new TaskOpen($this->container));
        $this->actionManager->register(new TaskMoveSpecificSwimlane($this->container));
        $this->actionManager->register(new MoveToProjectCategory($this->container));
        $this->actionManager->register(new ChangeCategoryCreation($this->container));
        $this->actionManager->register(new TaskRename($this->container));
        $this->actionManager->register(new TaskMoveColumnOpen($this->container));
        $this->actionManager->register(new ChangeAssigneeCreation($this->container));

    }




    public function getPluginName()
    {
        return 'MoreAutomaticActions';
    }
    public function getPluginDescription()
    {
        return t('New useful actions for your project');
    }
    public function getPluginAuthor()
    {
        return 'theserban';
    }
    public function getPluginVersion()
    {
        return '1.1';
    }
    public function getPluginHomepage()
    {
        return 'https://theserban.com';
    }
    public function getCompatibleVersion()
    {
        return '>=1.2.10';
    }
}
