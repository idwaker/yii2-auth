<?php

namespace idwaker\auth\models;

use Yii;

/**
 * This is the model class for table "auth_permission".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $parent
 * @property integer $rule_id
 * @property string $created_on
 * @property string $updated_on
 *
 * @property AuthRule $rule
 * @property AuthPermission $parent
 * @property AuthPermission[] $authPermissions
 * @property AuthRolePermission[] $authRolePermissions
 * @property AuthRole[] $roles
 */
class AuthPermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'created_on', 'updated_on'], 'required'],
            [['description'], 'string'],
            [['parent', 'rule_id'], 'integer'],
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
            'rule_id' => Yii::t('auth', 'Rule ID'),
            'created_on' => Yii::t('auth', 'Created On'),
            'updated_on' => Yii::t('auth', 'Updated On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRule()
    {
        return $this->hasOne(AuthRule::className(), ['id' => 'rule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AuthPermission::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthPermissions()
    {
        return $this->hasMany(AuthPermission::className(), ['parent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthRolePermissions()
    {
        return $this->hasMany(AuthRolePermission::className(), ['permission_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(AuthRole::className(), ['id' => 'role_id'])->viaTable('auth_role_permission', ['permission_id' => 'id']);
    }
}
