<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\User */

$this->title = Yii::t('auth', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('auth', 'Update');
?>

<fieldset class="user-update">

    <legend><?= Html::encode($this->title) ?></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</fieldset>
