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
<div class="rule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
