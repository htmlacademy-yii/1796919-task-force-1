<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int|null $price
 * @property int $category_id
 * @property string $created_at
 * @property string|null $finish_at
 * @property string $status
 * @property string|null $coordinates
 * @property int|null $city_id
 * @property int $customer_id
 * @property int|null $worker_id
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id', 'customer_id'], 'required'],
            [['title', 'description', 'status', 'coordinates'], 'string'],
            [['price', 'category_id', 'city_id', 'customer_id', 'worker_id'], 'integer'],
            [['created_at', 'finish_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'finish_at' => 'Finish At',
            'status' => 'Status',
            'coordinates' => 'Coordinates',
            'city_id' => 'City ID',
            'customer_id' => 'Customer ID',
            'worker_id' => 'Worker ID',
        ];
    }
}
