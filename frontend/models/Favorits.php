<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favorits".
 *
 * @property int $id
 * @property int $master_user_id
 * @property int $slave_user_id
 *
 * @property User $masterUser
 * @property User $slaveUser
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
            [['master_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['master_user_id' => 'id']],
            [['slave_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['slave_user_id' => 'id']],
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

    /**
     * Gets query for [[MasterUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMasterUser()
    {
        return $this->hasOne(User::className(), ['id' => 'master_user_id']);
    }

    /**
     * Gets query for [[SlaveUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSlaveUser()
    {
        return $this->hasOne(User::className(), ['id' => 'slave_user_id']);
    }
}
