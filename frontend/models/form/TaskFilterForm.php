<?php
namespace frontend\models\form;

use yii\base\Model;

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

}