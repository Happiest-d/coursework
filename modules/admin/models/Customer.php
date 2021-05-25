<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string|null $patronymic
 * @property string $surname
 * @property int $age
 * @property string $phone_num
 * @property string $address
 *
 * @property Order[] $orders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'age', 'phone_num', 'address'], 'required'],
            [['age'], 'integer'],
            [['name', 'patronymic', 'surname'], 'string', 'max' => 50],
            [['phone_num'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'surname' => 'Фамилия',
            'age' => 'Возраст',
            'phone_num' => 'Телефон',
            'address' => 'Адрес',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}
