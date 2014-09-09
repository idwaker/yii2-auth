<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'is_loggedin') ?>

    <?php // echo $form->field($model, 'last_loggedin') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('auth', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('auth', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
