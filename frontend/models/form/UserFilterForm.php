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

}