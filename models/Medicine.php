<?php

namespace app\models;

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
 *
 * @property Category $category
 * @property Type $type
 * @property Medicine-list[] $medicine-lists
 * @property Order-list[] $order-lists
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
            [['price', 'in_stock', 'critical_norm', 'category_id', 'type_id'], 'integer'],
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
            'name' => 'Name',
            'price' => 'Price',
            'in_stock' => 'In Stock',
            'critical_norm' => 'Critical Norm',
            'category_id' => 'Category ID',
            'type_id' => 'Type ID',
            'prod_tech' => 'Prod Tech',
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
     * Gets query for [[Medicine-lists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicine-lists()
    {
        return $this->hasMany(Medicine-list::className(), ['medicine_id' => 'id']);
    }

    /**
     * Gets query for [[Order-lists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder-lists()
    {
        return $this->hasMany(Order-list::className(), ['medicine_id' => 'id']);
    }
}
