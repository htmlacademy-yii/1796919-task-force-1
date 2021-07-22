<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favorits".
 *
 * @property int $id
 * @property int $master_user_id
 * @property int $slave_user_id
 */
class Favorits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['master_user_id', 'slave_user_id'], 'required'],
            [['master_user_id', 'slave_user_id'], 'integer'],
            [['master_user_id', 'slave_user_id'], 'unique', 'targetAttribute' => ['master_user_id', 'slave_user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_user_id' => 'Master User ID',
            'slave_user_id' => 'Slave User ID',
        ];
    }
}
