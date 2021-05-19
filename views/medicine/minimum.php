<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

use app\models\Category;
//use app\models\Type;
// use app\models\Order;
// use app\models\OrderList;
// use app\models\Medicine;
?>

<div class="row">
        <div col="12">
            <h1>Лекарства с минимальным запасом на складе</h1>
        </div>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'find_category')->dropDownList(ArrayHelper::map(Category::find()->asArray()->all(),'id','name'), ['prompt' => 'Все'])->label('Тип медикаментов:')?>
        
        <?= Html::submitButton('Получить', ['class' => 'btn btn-primary', 'name' => 'filter-button']) ?>
        
        <?php ActiveForm::end(); ?>
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
                        <th scope="col">Название</th>
                        <th scope="col">Цена</th>
                        <th scope="col">В наличии</th>
                        <th scope="col">Критическая норма</th>
                        <th scope="col">Технология</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($query as $row): ?>
                        <tr>
                            <td><?=$row["name"]?></td>
                            <td><?=$row["price"]?></td>
                            <td><?=$row["in_stock"]?></td>
                            <td><?=$row["critical_norm"]?></td>
                            <td><?=$row["prod_tech"]?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>
                <p>Количество записей: <?= count($query)?> </p>
            <? endif;?>
        </div>
    </div>
</div>

<?//= print_r($query) ?>
<?//= var_dump(empty($res)) ?>
<?//= var_dump($res) ?>
<?//= print_r(ArrayHelper::map(Category::find()->asArray()->all(),'id','name')) ?>