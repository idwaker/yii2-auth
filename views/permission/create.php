<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\Permission */

$this->title = Yii::t('auth', 'Create {modelClass}', [
    'modelClass' => 'Permission',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<fieldset class="permission-create">

    <legend><?= Html::encode($this->title) ?></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</fieldset>
