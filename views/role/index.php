<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel idwaker\auth\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('auth', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('auth', 'Create {modelClass}', [
    'modelClass' => 'Role',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            [
                'attribute' => 'parent',
                'value' => 'parent.name'
            ],
            'created_on',
            // 'updated_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
