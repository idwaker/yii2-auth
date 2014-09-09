<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model idwaker\auth\models\Role */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('auth', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('auth', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('auth', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('auth', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'parent',
            'created_on',
            'updated_on',
        ],
    ]) ?>

</div>
