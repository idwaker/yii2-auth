<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel idwaker\auth\models\PermissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('auth', 'Permissions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('auth', 'Create {modelClass}', [
    'modelClass' => 'Permission',
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
            'parent',
            'rule_id',
            // 'created_on',
            // 'updated_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
