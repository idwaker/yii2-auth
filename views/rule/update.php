<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\Rule */

$this->title = Yii::t('auth', 'Update {modelClass}: ', [
    'modelClass' => 'Rule',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('auth', 'Update');
?>

<fieldset class="rule-update">

    <legend><?= Html::encode($this->title) ?></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</fieldset>
