<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\Role */

$this->title = Yii::t('auth', 'Update {modelClass}: ', [
    'modelClass' => 'Role',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('auth', 'Update');
?>

<fieldset class="role-update">

    <legend><?= Html::encode($this->title) ?></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</fieldset>
