<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\User */

$this->title = Yii::t('auth', 'Create {modelClass}', [
    'modelClass' => 'User',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<fieldset class="user-create">

    <legend><?= Html::encode($this->title) ?></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</fieldset>
