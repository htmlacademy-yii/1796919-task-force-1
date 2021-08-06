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
 *
 * @property Favorits[] $favorits
 * @property Favorits[] $favorits0
 * @property File[] $files
 * @property Message[] $messages
 * @property Message[] $messages0
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Review[] $reviews0
 * @property Task[] $tasks
 * @property Task[] $tasks0
 * @property City $city
 * @property UserCategory[] $userCategories
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
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
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

    /**
     * Gets query for [[Favorits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorits()
    {
        return $this->hasMany(Favorits::className(), ['master_user_id' => 'id']);
    }

    /**
     * Gets query for [[Favorits0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorits0()
    {
        return $this->hasMany(Favorits::className(), ['slave_user_id' => 'id']);
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['recipient_id' => 'id']);
    }

    /**
     * Gets query for [[Messages0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages0()
    {
        return $this->hasMany(Message::className(), ['sender_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['worker_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews0()
    {
        return $this->hasMany(Review::className(), ['worker_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Task::className(), ['worker_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[UserCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }
}
