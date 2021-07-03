<?php
namespace taskforce\models\actions;

use taskforce\models\Task;

class RefuseAction extends AbstractAction
{
    protected $value = 'refuse';
    protected $name = 'Отказаться';

    public function checkPermission(int $worker_id, int $customer_id, int $user_id): bool
    {
        return $worker_id === $user_id;
    }
}
