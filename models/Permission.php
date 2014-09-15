<?php

namespace idwaker\auth\models;

use Yii;
use idwaker\auth\models\AuthPermission;
use idwaker\auth\models\Rule;
use yii\helpers\ArrayHelper;


class Permission extends AuthPermission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['permission_id', 'rule_id'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('auth', 'ID'),
            'name' => Yii::t('auth', 'Name'),
            'description' => Yii::t('auth', 'Description'),
            'permission_id' => Yii::t('auth', 'Parent'),
            'rule_id' => Yii::t('auth', 'Rule ID'),
            'created_on' => Yii::t('auth', 'Created On'),
            'updated_on' => Yii::t('auth', 'Updated On'),
        ];
    }
    
    public function getPermissionList()
    {
        return ArrayHelper::map(Permission::find()->asArray()->all(), 'id', 'name');
    }
    
    public function getRuleList()
    {
        return ArrayHelper::map(Rule::find()->asArray()->all(), 'id', 'name');
    }
}
