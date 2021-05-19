<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Перечень заказов (запрос 8)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'order_accep_date',
            //'order_issue_date',
            //'status_id',
            //'usage:ntext',
            //'customer_id',
            //'doctor_id',
            [
                'attribute' => 'status_id',
                'value' => function ($data) {
                    return $data->status->name;
                },
                'filter' => ArrayHelper::map(Status::find()->asArray()->all(),'id','name'),
                'label' => 'Статус заказа',
            ],
            'id',
            'order_accep_date',
            'order_issue_date',
            [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return $data->customer->surname;
                },
                'label' => 'Покупатель',
            ],
            [
                'attribute' => 'doctor_id',
                'value' => function ($data) {
                    return $data->doctor->surname;
                },
                'label' => 'Покупатель',
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
