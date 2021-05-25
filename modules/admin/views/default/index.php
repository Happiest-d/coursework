<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <p>CRUD</p> 
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <p><?= Html::a('Категории', ['category/index'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Компоненты', ['component/index'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Клиенты', ['customer/index'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Врачи', ['doctor/index'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Лекарства', ['medicine/index'], ['class' => 'btn btn-lg btn-primary btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Заказы', ['order/index'], ['class' => 'btn btn-lg btn-primary btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Статус заказа', ['status/index'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
            <div class="col-lg-12">
                <p><?= Html::a('Тип', ['type/index'], ['class' => 'btn btn-lg btn-success btn-block']) ?></p>
            </div>
        </div>

    </div>
</div>
