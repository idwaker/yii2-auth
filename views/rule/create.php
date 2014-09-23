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

<fieldset class="rule-create">

    <legend><?= Html::encode($this->title) ?></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</fieldset>
