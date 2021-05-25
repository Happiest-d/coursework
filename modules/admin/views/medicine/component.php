<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\modules\admin\models\Component;
?>

<h2>Добавить компонент</h2>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'medicine_id')->hiddenInput(['readonly' => true, 'value' => $id])->label(false) ?>

    <?= $form->field($model, 'component_id')->dropDownList(ArrayHelper::map(Component::find()->asArray()->all(),'id','name'))->label('Компонент');?>
    
    <?= $form->field($model, 'amount')->textInput() ?>

    <button class="btn btn-success">Добавить</button>

<?php ActiveForm::end() ?>