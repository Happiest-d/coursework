<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

//use app\models\Category;
use app\models\Type;
// use app\models\Order;
// use app\models\OrderList;
use app\models\Medicine;
?>

<div class="container content">
    <div class="row">
            <div col="12">
                <h1>Клиенты, наиболее часто делающие заказы на</h1>
            </div>
        </div>
        <div class="row">
            <div class="filter-form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'find_type')->dropDownList(ArrayHelper::map(Type::find()->asArray()->all(),'id','name'), ['prompt' => 'Все'])->label('Тип медикаментов:')?>

                <?= $form->field($model, 'find_id')->dropDownList(ArrayHelper::map(Medicine::find()->asArray()->all(),'id','name'), ['prompt' => 'Все'])->label('Выбрать медикамент:')?>

                <?= Html::submitButton('Получить', ['class' => 'btn btn-primary', 'name' => 'filter-button']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>  
        <br>
        <br>
        <div class="row wrap-table">
            <div class="col-12">
                <? if(count($query) == 0): ?>
                    <h4>Ничего не найдено</h4>
                <? else: ?>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col">Отчество</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Возраст</th>
                            <th scope="col">Телефон</th>
                            <th scope="col">Адрес</th>
                            <th scope="col">Счётчик</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($query as $row): ?>
                            <tr>
                                <td><?=$row["name"]?></td>
                                <td><?=$row["patronymic"]?></td>
                                <td><?=$row["surname"]?></td>
                                <td><?=$row["age"]?></td>
                                <td><?=$row["phone_num"]?></td>
                                <td><?=$row["address"]?></td>
                                <td><?=$row["counter"]?></td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                    <?= app\components\Counter::widget(['array'=> $query]) ?>
                <? endif;?>
            </div>
        </div>
    </div>
</div>


<?//= print_r($query) ?>
<?//= var_dump(empty($res)) ?>
<?//= var_dump($res) ?>
<?//= print_r(ArrayHelper::map(Category::find()->asArray()->all(),'id','name')) ?>