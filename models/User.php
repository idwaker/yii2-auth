<?php

namespace idwaker\auth\models;

use yii\web\IdentityInterface;
use idwaker\auth\models\AuthUser;


class User extends AuthUser implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
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
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        // implement
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type=null)
    {
        // implement
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        // implement
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        // implement
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthkey($authKey)
    {
        // implement
    }
}