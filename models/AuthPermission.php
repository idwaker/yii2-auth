<?php

namespace idwaker\auth\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


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
    public function getRule()
    {
        return $this->hasOne(AuthRule::className(), ['id' => 'rule_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AuthPermission::className(), ['id' => 'permission_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(AuthPermission::className(), ['permission_id' => 'id']);
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
