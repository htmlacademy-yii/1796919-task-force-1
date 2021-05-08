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
    const ACTION_RESPOND = 'respond'; // откликнуться
    const ACTION_FINISH = 'finish'; // завершить
    const ACTION_FAILURE = 'failure'; // провалить
    const ACTION_CANCEL = 'cancel'; // отменить
    const ACTION_START = 'start';

    public int $customerId;
    public int $workerId;
    private string $currentStatus;

    public function __construct(int $customerId, int $workerId, string $currentStatus)
    {
        $this->customerId = $customerId;
        $this->workerId = $workerId;
        $this->currentStatus = $currentStatus;
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
            self::ACTION_RESPOND => 'Respond',
            self::ACTION_CANCEL => 'Cancel',
            self::ACTION_FAILURE => 'Failure',
            self::ACTION_FINISH => 'Finish',
        ];
    }

    /**
     * Возможные действия для статуса
     * @return array
     */
    public function getPossibleActions(): array
    {
        $actions = $this->actions();

        switch ($this->currentStatus) {
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

    /**
     * Получение следующего статуса для действия
     * @param string $action
     * @return string|false
     */
    public function getNextStatus(string $action): string
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
                exit('Неизвестное действие');
        }
    }
}
