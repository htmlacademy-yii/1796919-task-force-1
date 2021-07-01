<?php
namespace taskforce\models;

use taskforce\models\actions\AbstractAction;
use taskforce\models\actions\ApproveAction;
use taskforce\models\actions\CancelAction;
use taskforce\models\actions\CompleteAction;
use taskforce\models\actions\RefuseAction;
use taskforce\models\actions\RespondAction;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORKING = 'working';
    const STATUS_COMPLETE = 'complete';
    const STATUS_FAIL = 'fail';

    const STATUS_ROLE_CUSTOMER = 'owner';
    const STATUS_ROLE_WORKER = 'doer';


    public int $customer_id;
    public int $worker_id;
    private string $current_status = self::STATUS_NEW;

    public function __construct(int $customer_id, int $worker_id, string $current_status)
    {
        $this->customer_id = $customer_id;
        $this->worker_id = $worker_id;
        $this->current_status = $current_status;
    }

    /**
     * Карта статусов
     * @return array
     */
    public function statuses(): array
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_CANCELED => 'Отменен',
            self::STATUS_WORKING => 'В работе',
            self::STATUS_COMPLETE => 'Завершен',
            self::STATUS_FAIL => 'Провален',
        ];
    }

    /**
     * Карта действий
     * @return array
     */
    public function actions(): array
    {
        return [
            self::STATUS_NEW => [
                'respond' => null,
                'refuse' => null,
                'cancel' => self::STATUS_CANCELED,
                'approve' => self::STATUS_WORKING
            ],
            self::STATUS_WORKING => [
                'refuse' => self::STATUS_FAIL,
                'complete' => self::STATUS_COMPLETE
            ],
            self::STATUS_CANCELED => [],
            self::STATUS_COMPLETE => [],
            self::STATUS_FAIL => []
        ];
    }

    public static function getAvailableActions($status) {
        switch ($status) {
            case self::STATUS_NEW:
                return [
                    new RespondAction(),
                    new RefuseAction(),
                    new CancelAction(),
                    new ApproveAction()
                ];
            case self::STATUS_WORKING:
                return [
                    new RefuseAction(),
                    new CompleteAction()
                ];
            case self::STATUS_CANCELED:
            case self::STATUS_COMPLETE:
            case self::STATUS_FAIL:
                return [];
        }
    }

    /**
     * Возможные действия для статуса
     * @return array
     */
    public function getPossibleActions(string $status, int $user_id): array
    {
        $actions = self::getAvailableActions($status);
        $result = [];
        foreach($actions as $action) {
            if($action->checkPermission($this->worker_id, $this->customer_id, $user_id)) {
                $result[] = $action;
            }
        }
        return $result;
    }
    
    /**
     * Получение следующего статуса для действия
     * @param AbstractAction $action
     * @return array
     */
    public function getNextStatus(AbstractAction $action): string
    {
        return self::statuses()[$this->current_status][$action->getValue()];
    }
}
