<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $task_id
 * @property int $customer_id
 * @property int $worker_id
 * @property string $body
 * @property int|null $rate
 * @property string $created_at
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'customer_id', 'worker_id', 'body'], 'required'],
            [['task_id', 'customer_id', 'worker_id', 'rate'], 'integer'],
            [['body'], 'string'],
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
            'customer_id' => 'Customer ID',
            'worker_id' => 'Worker ID',
            'body' => 'Body',
            'rate' => 'Rate',
            'created_at' => 'Created At',
        ];
    }
}
