<?php

namespace idwaker\auth\models;

use Yii;
use yii\helpers\ArrayHelper;
use idwaker\auth\models\AuthRole;
use idwaker\auth\models\Permission;


class Role extends AuthRole
{
    public $permissions = [];
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['role_id'], 'integer'],
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
            'role_id' => Yii::t('auth', 'Parent'),
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
    
    public function getRolePermissions()
    {
        return ArrayHelper::getColumn($this->getPermissions()->asArray()->all(), 'id');
    }

    public function load($data, $formName=null)
    {
        $scope = $formName === null ? $this->formName() : $formName;
        if ($scope == '' && !empty($data)) {
            $this->permissions = $data['permissions'];
        }
        elseif (isset($data[$scope])) {
            $this->permissions = $data[$scope]['permissions'];
        }
        else {
            // pass
        }
        return parent::load($data, $formName);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert === false) {
            // unlink all previously linked
        }
        if (!empty($this->permissions)) {
            foreach ($this->permissions as $perm) {
                $permission = Permission::findOne($perm);
                $this->link('permissions', $permission);
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }
}