<?php

namespace idwaker\auth\models;

use Yii;
use yii\web\IdentityInterface;
use idwaker\auth\models\AuthUser;


class User extends AuthUser implements IdentityInterface
{
    const STATUS_ACTIVE = 1;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username'], 'unique'],
            [['status', 'is_loggedin'], 'integer'],
            [['last_loggedin', 'created_on', 'updated_on'], 'safe'],
            [['username', 'password'], 'string', 'max' => 64],
            [['auth_key', 'secret_key'], 'string']
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
            'secret_key' => Yii::t('auth', 'Secret Key'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type=null)
    {
        $data = Yii::$app->getSecurity()->validateData($token, $this->secret_key);
        if ($data !== false) {
            $userData = json_decode(base64_decode($data));
            return User::findIdentity($userData['id']);
        }
        return false;
    }
    
    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    public function getAccessToken()
    {
        $data = base64encode(json_encode(["id" => $this->id]));
        return Yii::$app->getSecurity()->hashData($data, $this->secret_key);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthkey($authKey)
    {
        return $authKey === $this->auth_key;
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
    }
    
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                var_dump(Yii::$app->getSecurity()->generatePasswordHash($this->password));
                $this->password= Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }
            return true;
        }
        else {
            return false;
        }
    }
}