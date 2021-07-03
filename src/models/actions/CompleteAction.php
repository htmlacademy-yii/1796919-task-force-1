<?php
namespace taskforce\models\actions;

use taskforce\models\Task;

class CompleteAction extends AbstractAction
{
    protected $value = 'complete';
    protected $name = 'Завершить';

    public function checkPermission(int $worker_id, int $customer_id, int $user_id): bool
    {
        return $customer_id === $user_id;
    }
}
