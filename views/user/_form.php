<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'is_loggedin')->textInput() ?>

    <?= $form->field($model, 'last_loggedin')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('auth', 'Create') : Yii::t('auth', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
