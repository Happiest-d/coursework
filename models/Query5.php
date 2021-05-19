<?php
namespace app\models;

use yii\base\Model;

class Query5 extends Model
{
    public $find_category;
    public $find_type;
    public $find_id;
    public $date_start;
    public $date_end;

    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'required'],
            [['date_start', 'date_end'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Введите дату в формате гггг-мм-дд'],
            [['find_category', 'find_type', 'find_id'], 'integer'],
        ];
    }
}