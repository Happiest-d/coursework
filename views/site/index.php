<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="container">
    <h1 style="margin: 2em 1em">Запросы 1 -13</h1>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <p><?= Html::a('Статус заказа + покупатель (1)', ['order/status'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Ожидают компоненты (2)', ['order/waiting'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Наиболее используемые медикаменты (3)', ['medicine/oused'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Использовано компонентов (4)', ['medicine/substances'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Определенное лекарство с по (5)', ['medicine/order'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Критическая норма  AR(6)', ['medicine/critical'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Минимум на складе AR(7)', ['medicine/minimum'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Заказы в производстве DataProvider(8)', ['order/production'], ['class' => 'btn btn-lg btn-primary btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Перечень медикаментов для заказов (9)', ['order/porder'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Технология производства (10)', ['medicine/production'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Компоненты (11)', ['medicine/component'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Клиенты, наиболее часто делающие заказы на (12)', ['medicine/often'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Информация о медикаменте (13)', ['medicine/info'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
        </div>
    </div>
</div>
