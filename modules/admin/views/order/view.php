<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
// use yii\helpers\ArrayHelper;

// use app\modules\admin\models\Status;
// use app\modules\admin\models\Type;
// use app\modules\admin\models\Customer;
// use app\modules\admin\models\Doctor;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить лекарство', ['medicine', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны, что ходите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return $data->customer->surname;
                },
            ],
            [
                'attribute' => 'doctor_id',
                'value' => function ($data) {
                    return $data->doctor->surname;
                },
            ],
            'order_accep_date',
            'order_issue_date',
            [
                'attribute' => 'status_id',
                'value' => function ($data) {
                    return $data->status->name;
                },
            ],
            'usage:ntext',
        ],
    ]) ?>

    <br>
    <br>
    <h3>Лекарства</h3>
        <? if(count($medicines) == 0): ?>
            <h4>Ничего не найдено</h4>
        <? else: ?>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Клоичество</th>
                </tr>
                </thead>
                <tbody>
                <? foreach ($medicines as $row): ?>
                    <tr>
                        <td><?=$row["medicine"]["name"]?></td>
                        <td><?=$row["amount"]?></td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
            <p>Количество лекарств: <?= count($medicines)?> </p>
        <? endif;?>

</div>
