<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $birthday
 * @property string $register_at
 * @property int|null $city_id
 * @property string|null $avatar
 * @property string|null $about
 * @property string|null $phone
 * @property string|null $skype
 * @property string|null $telegram
 * @property string|null $other_contact
 * @property int $show_profile
 * @property int $show_contacts
 * @property int $notify_message
 * @property int $notify_review
 * @property int $notify_start
 * @property int $notify_cancel
 * @property int $notify_complete
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['birthday', 'register_at'], 'safe'],
            [['city_id', 'show_profile', 'show_contacts', 'notify_message', 'notify_review', 'notify_start', 'notify_cancel', 'notify_complete'], 'integer'],
            [['about', 'other_contact'], 'string'],
            [['name'], 'string', 'max' => 512],
            [['email'], 'string', 'max' => 256],
            [['password'], 'string', 'max' => 32],
            [['avatar'], 'string', 'max' => 1024],
            [['phone', 'skype', 'telegram'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'birthday' => 'Birthday',
            'register_at' => 'Register At',
            'city_id' => 'City ID',
            'avatar' => 'Avatar',
            'about' => 'About',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'other_contact' => 'Other Contact',
            'show_profile' => 'Show Profile',
            'show_contacts' => 'Show Contacts',
            'notify_message' => 'Notify Message',
            'notify_review' => 'Notify Review',
            'notify_start' => 'Notify Start',
            'notify_cancel' => 'Notify Cancel',
            'notify_complete' => 'Notify Complete',
        ];
    }
}
