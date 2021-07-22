<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "response".
 *
 * @property int $id
 * @property int $task_id
 * @property int $worker_id
 * @property string $comment
 * @property int $price
 * @property string $created_at
 */
class Response extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'worker_id', 'comment', 'price'], 'required'],
            [['task_id', 'worker_id', 'price'], 'integer'],
            [['comment'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'worker_id' => 'Worker ID',
            'comment' => 'Comment',
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }
}
