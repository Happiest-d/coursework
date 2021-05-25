<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\admin\models\Category;
use app\modules\admin\models\Type;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Medicine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medicine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'in_stock')->textInput() ?>

    <?= $form->field($model, 'critical_norm')->textInput() ?>
    
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(Type::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'prod_tech')->textarea(['rows' => 3]) ?>

    <?//= $form->field($model, 'counter')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
