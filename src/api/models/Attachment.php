<?php
class Attachment extends BaseModel {
    public $id = 0;
    public $filename = '';
    public $name = '';
    public $type = '';
    public $user_id = 0;
    public $timestamp = null;

    public function __construct($container, $id = 0) {
        parent::__construct('attachment', $id, $container);

        $this->loadFromBean($this->bean);
    }

    public function updateBean() {
        $bean = $this->bean;

        $bean->id = $this->id;
        $bean->filename = $this->filename;
        $bean->name = $this->name;
        $bean->type = $this->type;
        $bean->user_id = $this->user_id;
        $bean->timestamp = $this->timestamp;
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
        $this->filename = $obj->filename;
        $this->name = $obj->name;
        $this->type = $obj->type;
        $this->user_id = (int) $obj->user_id;
        $this->timestamp = (int) $obj->timestamp;
    }
}

