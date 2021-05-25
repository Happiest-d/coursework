<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Type */

$this->title = 'Создать тип';
$this->params['breadcrumbs'][] = ['label' => 'Типы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
