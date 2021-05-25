<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\modules\admin\models\Medicine;
?>

<h2>Добавить лекарство</h2>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'order_id')->hiddenInput(['readonly' => true, 'value' => $id])->label(false) ?>

    <?= $form->field($model, 'medicine_id')->dropDownList(ArrayHelper::map(Medicine::find()->asArray()->all(),'id','name'))->label('Лекарство');?>
    
    <?= $form->field($model, 'amount')->textInput() ?>

    <button class="btn btn-success">Добавить</button>

<?php ActiveForm::end() ?>