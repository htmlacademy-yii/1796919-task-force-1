<?php

namespace frontend\models;

use frontend\models\form\TaskFilterForm;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class TaskSearch extends TaskFilterForm
{

    public function search($params)
    {
        $query = Task::find()
            ->where(['status' => \taskforce\models\Task::STATUS_NEW])
            ->with(['category', 'city']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);


        if(!empty($this->categories)) {
            $query->andWhere(['in', 'category_id', $this->categories]);
        }

        if($this->no_worker) {
            $query->join('LEFT JOIN', 'response', 'task.id = response.task_id')
                ->andWhere(['response.task_id' => null]);
        }

        if($this->remote_task) {
            $query->andWhere(['city_id' => null]);
        }

        switch ($this->period) {
            case self::PERIOD_DAY:
                $query->andWhere(['>', 'task.created_at', new Expression('DATE_SUB(NOW(), INTERVAL 1 DAY)')]);
                break;
            case self::PERIOD_WEEK:
                $query->andWhere(['>', 'task.created_at', new Expression('DATE_SUB(NOW(), INTERVAL 1 WEEK)')]);
                break;
            case self::PERIOD_MONTH:
                $query->andWhere(['>', 'task.created_at', new Expression('DATE_SUB(NOW(), INTERVAL 1 MONTH)')]);
                break;
        }

        if($this->title) {
            $query->andWhere(['like', 'title', $this->title]);
        }

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}