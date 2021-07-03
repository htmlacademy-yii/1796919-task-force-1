<?php
namespace taskforce\models\actions;

use taskforce\models\Task;

class CancelAction extends AbstractAction
{
    protected $value = 'cancel';
    protected $name = 'Отменить';

    public function checkPermission(int $worker_id, int $customer_id, int $user_id): bool
    {
        return $customer_id === $user_id;
    }
}
