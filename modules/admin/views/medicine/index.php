<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use app\modules\admin\models\Category;
use app\modules\admin\models\Type;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MedicineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лекарства';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medicine-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить лекарство', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'price',
            'in_stock',
            'critical_norm',
            [
                'attribute' => 'category_id',
                'value' => function ($data) {
                    return $data->category->name;
                },
                'filter' => ArrayHelper::map(Category::find()->asArray()->all(),'id','name'),
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return $data->type->name;
                },
                'filter' => ArrayHelper::map(Type::find()->asArray()->all(),'id','name'),
            ],
            //'category_id',
            //'type_id',
            'prod_tech:ntext',
            //'counter',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
