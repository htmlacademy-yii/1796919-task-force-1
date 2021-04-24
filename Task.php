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
    const ACTION_FINISH = 'finish';
    const ACTION_FAILURE = 'failure';
    const ACTION_CANCEL = 'cancel';
    const ACTION_START = 'start';

    public $customerId;
    public $workerId;
    private $_currentStatus;


    public function __construct($customer_id, $worker_id, $currentStatus)
    {
        $this->customerId = $customer_id;
        $this->workerId = $worker_id;
        $this->_currentStatus = $currentStatus;
    }

    public function statuses()
    {
        return [];
    }

    public function actions()
    {
        return [];
    }

    public function getPossibleActions() {

    }

    public function getStatus($action)
    {
        # code...
    }



}
