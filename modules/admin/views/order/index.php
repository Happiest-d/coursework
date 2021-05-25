<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\modules\admin\models\Status;
use app\modules\admin\models\Type;
use app\modules\admin\models\Customer;
use app\modules\admin\models\Doctor;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return $data->customer->surname;
                },
                'filter' => ArrayHelper::map(Customer::find()->asArray()->all(),'id','surname'),
            ],
            [
                'attribute' => 'doctor_id',
                'value' => function ($data) {
                    return $data->doctor->surname;
                },
                'filter' => ArrayHelper::map(Doctor::find()->asArray()->all(),'id','surname'),
            ],
            'order_accep_date',
            'order_issue_date',
            [
                'attribute' => 'status_id',
                'value' => function ($data) {
                    return $data->status->name;
                },
                'filter' => ArrayHelper::map(Status::find()->asArray()->all(),'id','name'),
            ],
            'usage:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
