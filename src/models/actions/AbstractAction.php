<?php
namespace taskforce\models\actions;

use taskforce\models\Task;

abstract class AbstractAction
{
    protected $name;
    protected $value;

    public function getValue() {
        return $this->value;
    }

    public function getName() {
        return $this->name;
    }

    abstract public function checkPermission(int $worker_id, int $customer_id, int $user_id) :bool;
}
