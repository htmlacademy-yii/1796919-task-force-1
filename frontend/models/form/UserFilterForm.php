<?php
namespace frontend\models\form;

use frontend\models\User;
use taskforce\models\Task;
use yii\base\Model;
use yii\db\Expression;

class UserFilterForm extends Model
{
    public $category;
    public $username;
    public $user_free;
    public $user_online;
    public $user_has_reviews;
    public $user_has_favorite;

    public function rules() : array
    {
        return [
            ['category', 'exist'],
            ['username', 'string'],
            [['user_free', 'user_online', 'user_has_reviews', 'user_has_favorite'], 'boolean'],
        ];
    }

    public function attributeLabels() : array
    {
        return [
            'category' => 'Категории',
            'username' => 'Поиск по имени',
            'user_free' => 'Сейчас свободен',
            'user_online' => 'Сейчас онлайн',
            'user_has_reviews' => 'Есть отзывы',
            'user_has_favorite' => 'В избранном',
        ];
    }

    public function getUsers() : array
    {
        $users = User::find()
            ->where(['role' => 'worker'])
            ->with('reviewsAsWorker', 'tasksAsWorker');

        if(!empty($this->category)) {
            $users->leftJoin('user_category', 'user.id = user_category.user_id')
                ->andWhere(['IN', 'user_category.category_id', $this->category]);
        }

        if($this->user_free) {
            $users->leftJoin(
                'task',
                'user.id = task.worker_id AND task.status = :status',
                [':status' => Task::STATUS_WORKING]
            )->groupBy('user.id')
                ->andHaving(['COUNT(task.id)' => '0']);
        }

        if($this->user_online) {
            $users->andWhere([
                '>',
                'user.activity',
                new Expression('DATE_SUB(NOW(), INTERVAL 30 MINUTE)')
            ]);
        }

        if($this->user_has_reviews) {
            $users->leftJoin('review', 'user.id = review.worker_id')
                ->andWhere(['not', ['review.worker_id' => null]]);
        }

        if($this->user_has_favorite) {
            $users->leftJoin('favorits', 'user.id = favorits.slave_user_id')
                ->andWhere(['not', ['favorits.slave_user_id' => null]]);
        }

        if($this->username) {
            $users->andWhere(['like', 'name', $this->username]);
        }

        return $users->all();
    }
}