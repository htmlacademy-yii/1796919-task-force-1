<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $task_id
 * @property int $sender_id
 * @property int $recipient_id
 * @property string $body
 * @property int $was_read
 * @property string $created_at
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'sender_id', 'recipient_id', 'body'], 'required'],
            [['task_id', 'sender_id', 'recipient_id', 'was_read'], 'integer'],
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
            'sender_id' => 'Sender ID',
            'recipient_id' => 'Recipient ID',
            'body' => 'Body',
            'was_read' => 'Was Read',
            'created_at' => 'Created At',
        ];
    }
}
