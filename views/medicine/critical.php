<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

//use app\models\Category;
use app\models\Type;
// use app\models\Order;
// use app\models\OrderList;
// use app\models\Medicine;
?>

<div class="row">
        <div col="12">
            <h1>Лекарства, достигшие своей критической нормы или закончившиеся</h1>
        </div>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'find_type')->dropDownList(ArrayHelper::map(Type::find()->asArray()->all(),'id','name'), ['prompt' => 'Все'])->label('Тип медикаментов:')?>
        
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
                        <th scope="col">Препарат</th>
                        <th scope="col">Тип</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($query as $row): ?>
                        <tr>
                            <td><?=$row["name"]?></td>
                            <td><?=$row["type"]["name"]?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>
                <p>Количество записей: <?= count($query)?> </p>
            <? endif;?>
        </div>
    </div>
</div>


<pre><?= print_r($critical) ?></pre>
<?//= print_r($query) ?>
<?//= var_dump(empty($res)) ?>
<?//= var_dump($res) ?>
<?//= print_r(ArrayHelper::map(Category::find()->asArray()->all(),'id','name')) ?>