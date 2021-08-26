<?php

namespace frontend\models;

use frontend\models\form\UserFilterForm;
use taskforce\models\Task;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class UsersSearch extends UserFilterForm
{

    public function search($params)
    {
        $query = User::find()
            ->where(['role' => 'worker'])
            ->with('reviewsAsWorker', 'tasksAsWorker');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);


        if(!empty($this->category)) {
            $query->leftJoin('user_category', 'user.id = user_category.user_id')
                ->andWhere(['IN', 'user_category.category_id', $this->category]);
        }

        if($this->user_free) {
            $query->leftJoin(
                'task',
                'user.id = task.worker_id AND task.status = :status',
                [':status' => Task::STATUS_WORKING]
            )->groupBy('user.id')
                ->andHaving(['COUNT(task.id)' => '0']);
        }

        if($this->user_online) {
            $query->andWhere([
                '>',
                'user.activity',
                new Expression('DATE_SUB(NOW(), INTERVAL 30 MINUTE)')
            ]);
        }

        if($this->user_has_reviews) {
            $query->leftJoin('review', 'user.id = review.worker_id')
                ->andWhere(['not', ['review.worker_id' => null]]);
        }

        if($this->user_has_favorite) {
            $query->leftJoin('favorits', 'user.id = favorits.slave_user_id')
                ->andWhere(['not', ['favorits.slave_user_id' => null]]);
        }

        if($this->username) {
            $query->andWhere(['like', 'name', $this->username]);
        }

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}