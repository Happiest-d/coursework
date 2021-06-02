<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\models\Status;
use app\models\Customer;
use app\models\Doctor;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Перечень заказов (запрос 8)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container content">
    <div class="order-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

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
                    'filter' => ArrayHelper::map(Customer::find()->asArray()->all(),'id','surname'),
                    'label' => 'Покупатель',
                ],
                [
                    'attribute' => 'doctor_id',
                    'value' => function ($data) {
                        return $data->doctor->surname;
                    },
                    'filter' => ArrayHelper::map(Doctor::find()->asArray()->all(),'id','surname'),
                    'label' => 'Доктор',
                ],

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>


    </div>
</div>