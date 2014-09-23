<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\Permission */

$this->title = Yii::t('auth', 'Update {modelClass}: ', [
    'modelClass' => 'Permission',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('auth', 'Update');
?>

<fieldset class="permission-update">

    <legend><?= Html::encode($this->title) ?></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</fieldset>
