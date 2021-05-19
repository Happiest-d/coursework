<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "component".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $in_stock
 *
 * @property Medicine-list[] $medicine-lists
 */
class Component extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'in_stock'], 'required'],
            [['price', 'in_stock'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[Medicine-lists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicineLists()
    {
        return $this->hasMany(MedicineList::className(), ['component_id' => 'id']);
    }
}
