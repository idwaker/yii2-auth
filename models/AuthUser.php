<?php

namespace idwaker\auth\models;

use Yii;

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
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password', 'last_loggedin', 'created_on', 'updated_on'], 'required'],
            [['status', 'is_loggedin'], 'integer'],
            [['last_loggedin', 'created_on', 'updated_on'], 'safe'],
            [['username', 'password'], 'string', 'max' => 64],
            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('auth', 'ID'),
            'username' => Yii::t('auth', 'Username'),
            'auth_key' => Yii::t('auth', 'Auth Key'),
            'password' => Yii::t('auth', 'Password'),
            'status' => Yii::t('auth', 'Status'),
            'is_loggedin' => Yii::t('auth', 'Is Loggedin'),
            'last_loggedin' => Yii::t('auth', 'Last Loggedin'),
            'created_on' => Yii::t('auth', 'Created On'),
            'updated_on' => Yii::t('auth', 'Updated On'),
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
