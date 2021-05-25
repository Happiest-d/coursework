<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "medicine_list".
 *
 * @property int $medicine_id
 * @property int $component_id
 * @property int $amount
 *
 * @property Component $component
 * @property Medicine $medicine
 */
class MedicineList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicine_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medicine_id', 'component_id', 'amount'], 'required'],
            [['medicine_id', 'component_id', 'amount'], 'integer'],
            [['component_id'], 'exist', 'skipOnError' => true, 'targetClass' => Component::className(), 'targetAttribute' => ['component_id' => 'id']],
            [['medicine_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicine::className(), 'targetAttribute' => ['medicine_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'medicine_id' => 'Medicine ID',
            'component_id' => 'Component ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(Component::className(), ['id' => 'component_id']);
    }

    /**
     * Gets query for [[Medicine]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicine()
    {
        return $this->hasOne(Medicine::className(), ['id' => 'medicine_id']);
    }
}
