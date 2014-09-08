<?php

namespace idwaker\auth\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "auth_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password
 * @property integer $status
 * @property integer $is_loggedin
 * @property string $last_loggedin
 * @property string $created_on
 * @property string $updated_on
 *
 * @property AuthUserRole[] $authUserRoles
 * @property AuthRole[] $roles
 */
class AuthUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_user';
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
    public function getAuthUserRoles()
    {
        return $this->hasMany(AuthUserRole::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(AuthRole::className(), ['id' => 'role_id'])->viaTable('auth_user_role', ['user_id' => 'id']);
    }
}
