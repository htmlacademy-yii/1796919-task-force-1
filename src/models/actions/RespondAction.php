<?php
namespace taskforce\models\actions;

use taskforce\models\Task;

class RespondAction extends AbstractAction
{
    protected $value = 'respond';
    protected $name = 'Откликнуться';

    public function checkPermission(int $worker_id, int $customer_id, int $user_id) :bool
    {
        return $worker_id === $user_id;
    }
}
