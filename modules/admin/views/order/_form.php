<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\admin\models\Status;
use app\modules\admin\models\Type;
use app\modules\admin\models\Customer;
use app\modules\admin\models\Doctor;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()->asArray()->all(),'id','surname')) ?>

    <?= $form->field($model, 'doctor_id')->dropDownList(ArrayHelper::map(Doctor::find()->asArray()->all(),'id','surname')) ?>

    <?= $form->field($model, 'order_accep_date')->textInput(['placeholder'=>'гггг-мм-дд']) ?>

    <?= $form->field($model, 'order_issue_date')->textInput(['placeholder'=>'гггг-мм-дд']) ?>

    <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(Status::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'usage')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
