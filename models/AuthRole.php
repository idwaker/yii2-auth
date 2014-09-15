<?php

namespace idwaker\auth\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "auth_role".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $parent
 * @property string $created_on
 * @property string $updated_on
 *
 * @property AuthRole $parent
 * @property AuthRole[] $authRoles
 * @property AuthRolePermission[] $authRolePermissions
 * @property AuthPermission[] $permissions
 * @property AuthUserRole[] $authUserRoles
 * @property AuthUser[] $users
 */
class AuthRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_role';
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_on',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_on',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AuthRole::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AuthRole::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthRolePermissions()
    {
        return $this->hasMany(AuthRolePermission::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(AuthPermission::className(), ['id' => 'permission_id'])->viaTable('auth_role_permission', ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthUserRoles()
    {
        return $this->hasMany(AuthUserRole::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(AuthUser::className(), ['id' => 'user_id'])->viaTable('auth_user_role', ['role_id' => 'id']);
    }
}
