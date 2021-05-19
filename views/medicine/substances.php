<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

//use app\models\Category;
use app\models\Type;
// use app\models\Order;
// use app\models\OrderList;
use app\models\Component;
?>

<div class="row">
        <div col="12">
            <h1>Использовано компонентов</h1>
        </div>
    </div>
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'date_start')->textInput(['placeholder'=>'гггг-мм-дд'])->label('С')?>  

        <?= $form->field($model, 'date_end')->textInput(['placeholder'=>'гггг-мм-дд'])->label('По')?> 
        
        <?= $form->field($model, 'find_id')->dropDownList(ArrayHelper::map(Component::find()->asArray()->all(),'id','name'), ['prompt' => 'Все'])->label('Выбрать компонент:')?>

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
                        <th scope="col">Количество</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($query as $row): ?>
                        <tr>
                            <td><?=$row["name"]?></td>
                            <td><?=$row["amount"]?></td>
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