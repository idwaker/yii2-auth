<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\Rule */

$this->title = Yii::t('auth', 'Create {modelClass}', [
    'modelClass' => 'Rule',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
