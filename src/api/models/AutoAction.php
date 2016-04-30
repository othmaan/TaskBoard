<?php
use MyCLabs\Enum\Enum;

class ActionTrigger extends Enum {
    const MoveToColumn = 1;
    const AssignedToUser = 2;
    const SetToCategory = 3;
}

class ActionType extends Enum {
    const SetColor = 1;
    const SetCategory = 2;
    const SetAssignee = 3;
    const ClearDueDate = 4;
}

class AutoAction extends BaseModel {
    public $id = 0;
    public $trigger = ActionTrigger::MoveToColumn;
    public $trigger_id = 0; // ID of the column etc. which triggers the action
    public $type = ActionType::SetColor;
    public $change_to = ''; // Whatever the target of the action changes to

    public function __construct($container, $id = 0) {
        parent::__construct('auto_action', $id, $container);

        $this->loadFromBean($this->bean);
    }

    public function updateBean() {
        $bean = $this->bean;

        $bean->id = $this->id;
        $bean->trigger = $this->trigger;
        $bean->trigger_id = $this->trigger_id;
        $bean->type = $this->type;
        $bean->change_to = $this->change_to;
    }

    public function loadFromBean($bean) {
        if (!isset($bean->id) || $bean->id === 0) {
            return;
        }

        $this->loadPropertiesFrom($bean);
    }

    public function loadFromJson($json) {
        $obj = json_decode($json);

        if (!isset($obj->id) || $obj->id === 0) {
            return;
        }

        $this->loadPropertiesFrom($obj);
    }

    private function loadPropertiesFrom($obj) {
        $this->id = (int) $obj->id;
        $this->trigger = new ActionTrigger((int) $obj->trigger);
        $this->trigger_id = (int) $obj->trigger_id;
        $this->type = new ActionType((int) $obj->type);
        $this->change_to = $obj->change_to;
    }
}

