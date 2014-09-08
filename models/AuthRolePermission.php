<?php

namespace idwaker\auth\models;

use Yii;

/**
 * This is the model class for table "auth_role_permission".
 *
 * @property integer $role_id
 * @property integer $permission_id
 *
 * @property AuthPermission $permission
 * @property AuthRole $role
 */
class AuthRolePermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_role_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'permission_id'], 'required'],
            [['role_id', 'permission_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => Yii::t('auth', 'Role ID'),
            'permission_id' => Yii::t('auth', 'Permission ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission()
    {
        return $this->hasOne(AuthPermission::className(), ['id' => 'permission_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(AuthRole::className(), ['id' => 'role_id']);
    }
}
