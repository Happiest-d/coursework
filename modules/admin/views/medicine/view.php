<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Medicine */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Лекарства', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medicine-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить компонент', ['component', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны, что хотите удалить данную запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return $data->type->name;
                },
            ],
            'prod_tech:ntext',
            //'counter',
        ],
    ]) ?>

    <br>
    <br>
    <h3>Компоненты</h3>
        <? if(count($components) == 0): ?>
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
                <? foreach ($components as $row): ?>
                    <tr>
                        <td><?=$row["component"]["name"]?></td>
                        <td><?=$row["amount"]?></td>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
            <p>Количество компонентов: <?= count($components)?> </p>
        <? endif;?>

</div>
