<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $order_accep_date
 * @property string $order_issue_date
 * @property int $status_id
 * @property string|null $usage
 * @property int $customer_id
 * @property int $doctor_id
 *
 * @property Customer $customer
 * @property Doctor $doctor
 * @property Status $status
 * @property OrderList[] $orderLists
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    public $find_category;
    public $find_status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_accep_date', 'order_issue_date', 'status_id', 'customer_id', 'doctor_id'], 'required'],
            [['order_accep_date', 'order_issue_date'], 'safe'],
            [['status_id', 'customer_id', 'doctor_id', 'find_status'], 'integer'],
            [['usage', 'find_category'], 'string'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctor::className(), 'targetAttribute' => ['doctor_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_accep_date' => 'Принят',
            'order_issue_date' => 'Истекает',
            'status_id' => 'Статус',
            'usage' => 'Инструкция',
            'customer_id' => 'Покупатель',
            'doctor_id' => 'Доктор',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Doctor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Doctor::className(), ['id' => 'doctor_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[OrderLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderLists()
    {
        return $this->hasMany(OrderList::className(), ['order_id' => 'id']);
    }

    public function getMedicine()
    {
        return $this->hasMany(Medicine::className(), ['id' => 'medicine_id'])->viaTable('order_list', ['order_id' => 'id']);
    }
}
