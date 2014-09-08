<?php

namespace idwaker\auth\models;

use Yii;

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
    public function rules()
    {
        return [
            [['name', 'created_on', 'updated_on'], 'required'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AuthRole::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthRoles()
    {
        return $this->hasMany(AuthRole::className(), ['parent' => 'id']);
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
