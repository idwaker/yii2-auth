<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\RuleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'data') ?>

    <?= $form->field($model, 'created_on') ?>

    <?= $form->field($model, 'updated_on') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('auth', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('auth', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
