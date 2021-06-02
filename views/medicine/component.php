<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

//use app\models\Category;
//use app\models\Type;
// use app\models\Order;
// use app\models\OrderList;
use app\models\Medicine;
?>

<div class="container content">
    <div class="row">
            <div col="12">
                <h1>Компоненты</h1>
            </div>
        </div>
        <div class="row">
            <div class="filter-form">
                <?php $form = ActiveForm::begin(); ?>
                
                <?= $form->field($model, 'find_id')->dropDownList(ArrayHelper::map(Medicine::find()->asArray()->all(),'id','name'), ['prompt' => 'Выберите медикамент из списка'])->label('Выбрать медикамент:')?>

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
                        <tbody>
                            <tr>
                                <td>Название</td><td><?=$query['0']["name"]?></td>
                            </tr>
                            <tr>
                                <td>Цена</td><td><?=$query['0']["price"]?></td>
                            </tr>
                        </tbody>
                    </table>
                    <h1>Компоненты</h1>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Название</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Количество</th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($query as $row): ?>
                            <tr>
                                <td><?=$row["c_name"]?></td>
                                <td><?=$row["c_price"]?></td>
                                <td><?=$row["amount"]?></td>
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