<?php

namespace idwaker\auth\models;

use Yii;

/**
 * This is the model class for table "auth_user_role".
 *
 * @property integer $user_id
 * @property integer $role_id
 *
 * @property AuthRole $role
 * @property AuthUser $user
 */
class AuthUserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_user_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'required'],
            [['user_id', 'role_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('auth', 'User ID'),
            'role_id' => Yii::t('auth', 'Role ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(AuthRole::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(AuthUser::className(), ['id' => 'user_id']);
    }
}
