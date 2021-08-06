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
 * @property string|null $created_at
 *
 * @property User $recipient
 * @property User $sender
 * @property Task $task
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
            [['recipient_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recipient_id' => 'id']],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
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

    /**
     * Gets query for [[Recipient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient()
    {
        return $this->hasOne(User::className(), ['id' => 'recipient_id']);
    }

    /**
     * Gets query for [[Sender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
