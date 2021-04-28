<?php

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORKING = 'working';
    const STATUS_COMPLETE = 'complete';
    const STATUS_FAIL = 'fail';

    const STATUS_ROLE_CUSTOMER = 'owner';
    const STATUS_ROLE_WORKER = 'doer';

    const ACTION_CREATE = 'create';
    const ACTION_RESPOND = 'respond';
    const ACTION_FINISH = 'finish';
    const ACTION_FAILURE = 'failure';
    const ACTION_CANCEL = 'cancel';
    const ACTION_START = 'start';

    public int $customer_id;
    public int $worker_id;
    private $current_status;

    public function __construct(int $customer_id, int $worker_id, string $current_status)
    {
        $this->customerId = $customer_id;
        $this->workerId = $worker_id;
        $this->currentStatus = $current_status;
    }

    public function statuses()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_CANCELED => 'Отменен',
            self::STATUS_WORKING => 'В работе',
            self::STATUS_COMPLETE => 'Завершен',
            self::STATUS_FAIL => 'Провален',
        ];
    }

    public function actions()
    {
        return [
            self::ACTION_RESPOND => 'Respond',
            self::ACTION_CANCEL => 'Cancel',
            self::ACTION_FAILURE => 'Failure',
            self::ACTION_FINISH => 'Finish',
        ];
    }

    public function getPossibleActions() {

        $actions = $this->actions();

        switch ($this->current_status) {
            case self::STATUS_NEW:
                return [
                    $actions[self::ACTION_RESPOND],
                    $actions[self::ACTION_CANCEL],
                ];
            case self::STATUS_WORKING:
                return [
                    $actions[self::ACTION_FAILURE],
                    $actions[self::ACTION_FINISH],
                ];
            default:
                return [];
        }
    }

    public function getNextStatus(string $action)
    {
        switch ($action) {
            case self::ACTION_RESPOND:
                return self::STATUS_WORKING;
            case self::ACTION_CANCEL:
                return self::STATUS_CANCELED;
            case self::ACTION_FAILURE:
                return self::STATUS_FAIL;
            case self::ACTION_FINISH:
                return self::STATUS_COMPLETE;
            default:
                return false;
        }
    }



}
