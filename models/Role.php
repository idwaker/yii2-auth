<?php

namespace idwaker\auth\models;

use Yii;
use yii\helpers\ArrayHelper;
use idwaker\auth\models\AuthRole;
use idwaker\auth\models\Permission;


class Role extends AuthRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['parent'], 'integer'],
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
            'parent' => Yii::t('auth', 'Parent'),
            'created_on' => Yii::t('auth', 'Created On'),
            'updated_on' => Yii::t('auth', 'Updated On'),
            'permissions' => Yii::t('auth', 'Permissions'),
        ];
    }
    
    public function getRoleList()
    {
        return ArrayHelper::map(Role::find()->asArray()->all(), 'id', 'name');
    }
    
    public function getPermissionList()
    {
        return ArrayHelper::map(Permission::find()->asArray()->all(), 'id', 'name');
    }
}