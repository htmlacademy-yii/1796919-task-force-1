<?php
namespace frontend\models\form;

use frontend\models\Task;
use yii\base\Model;
use yii\db\Expression;

class TaskFilterForm extends Model
{
    public $categories;
    public $title;
    public $period;
    public $no_worker;
    public $remote_task;

    public const PERIOD_DAY = 'day';
    public const PERIOD_WEEK = 'week';
    public const PERIOD_MONTH = 'month';

    public const PERIOD_ARRAY = [
        self::PERIOD_DAY => 'За день',
        self::PERIOD_WEEK => 'За неделю',
        self::PERIOD_MONTH => 'За месяц'
    ];

    public function rules() : array
    {
        return [
            ['categories', 'exist'],
            [['title', 'period'], 'string'],
            ['period', 'in', 'range' => self::PERIOD_ARRAY],
            [['no_worker', 'remote_task'], 'boolean'],
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'categories' => 'Категории',
            'title' => 'Поиск по названию',
            'period' => 'Период',
            'no_worker' => 'Без исполнителя',
            'remote_task' => 'Удалённая работа',
        ];
    }

    public function getTasks() : array
    {
        $tasks = Task::find()
            ->where(['status' => \taskforce\models\Task::STATUS_NEW])
            ->with(['category', 'city']);

        if(!empty($this->categories)) {
            $tasks->andWhere(['in', 'category_id', $this->categories]);
        }

        if($this->no_worker) {
            $tasks->join('LEFT JOIN', 'response', 'task.id = response.task_id')
                ->andWhere(['response.task_id' => null]);
        }

        if($this->remote_task) {
            $tasks->andWhere(['city_id' => null]);
        }

        switch ($this->period) {
            case self::PERIOD_DAY:
                $tasks->andWhere(['>', 'task.created_at', new Expression('DATE_SUB(NOW(), INTERVAL 1 DAY)')]);
                break;
            case self::PERIOD_WEEK:
                $tasks->andWhere(['>', 'task.created_at', new Expression('DATE_SUB(NOW(), INTERVAL 1 WEEK)')]);
                break;
            case self::PERIOD_MONTH:
                $tasks->andWhere(['>', 'task.created_at', new Expression('DATE_SUB(NOW(), INTERVAL 1 MONTH)')]);
                break;
        }

        if($this->title) {
            $tasks->andWhere(['like', 'title', $this->title]);
        }

        return $tasks->all();
    }

    public function setCategory(int $category_id) : void
    {
        $this->categories = [$category_id];
    }
}