<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\PermissionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'parent') ?>

    <?= $form->field($model, 'rule_id') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('auth', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('auth', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
