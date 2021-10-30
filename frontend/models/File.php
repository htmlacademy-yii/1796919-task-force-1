<?php

namespace frontend\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $path
 *
 * @property Task $task
 * @property User $user
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id', 'path'], 'required'],
            [['user_id', 'task_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
         //   [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'task_id' => 'Task ID',
            'path' => 'Path',
        ];
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function saveFiles(array $files, string $unique_string) : array
    {
        $upload_dir = Yii::getAlias('@webroot/upload');

        if(!file_exists($upload_dir)) {
            FileHelper::createDirectory($upload_dir);
        }


        $result_array = [];
        foreach ($files as $file) {
            $new_name = $unique_string.'_' .uniqid() . '.' . $file->getExtension();

            $file->saveAs($upload_dir . '/' . $new_name);

            $task_file = new File();
            $task_file->user_id = Yii::$app->user->id;
            $task_file->task_id = 0;
            $task_file->path = '/upload/' . $new_name;
            $task_file->unique_string = $unique_string;
            $task_file->save();
            $result_array[] = [
                'path' => $task_file->path,
                'type' => 'type'
            ];
        }
        /*
         * На основании это json-массива фронтэндер должен написать вывод загруженных файлов в форму
        */
        return $result_array;
    }
}
