<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "medicine".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $in_stock
 * @property int $critical_norm
 * @property int $category_id
 * @property int $type_id
 * @property string|null $prod_tech
 * @property int $counter
 *
 * @property Category $category
 * @property Type $type
 * @property MedicineList[] $medicineLists
 * @property OrderList[] $orderLists
 */
class Medicine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'in_stock', 'critical_norm', 'category_id', 'type_id'], 'required'],
            [['price', 'in_stock', 'critical_norm', 'category_id', 'type_id', 'counter'], 'integer'],
            [['prod_tech'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'price' => 'Стоимость',
            'in_stock' => 'В наличии',
            'critical_norm' => 'Критическая норма',
            'category_id' => 'Категория',
            'type_id' => 'Тип',
            'prod_tech' => 'Технология',
            'counter' => 'Счётчик',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[MedicineLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicineLists()
    {
        return $this->hasMany(MedicineList::className(), ['medicine_id' => 'id']);
    }

    /**
     * Gets query for [[OrderLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderLists()
    {
        return $this->hasMany(OrderList::className(), ['medicine_id' => 'id']);
    }
}
