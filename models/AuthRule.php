<?php

namespace idwaker\auth\models;

use Yii;

/**
 * This is the model class for table "auth_rule".
 *
 * @property integer $id
 * @property string $name
 * @property string $data
 * @property string $created_on
 * @property string $updated_on
 *
 * @property AuthPermission[] $authPermissions
 */
class AuthRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_on', 'updated_on'], 'required'],
            [['data'], 'string'],
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
            'data' => Yii::t('auth', 'Data'),
            'created_on' => Yii::t('auth', 'Created On'),
            'updated_on' => Yii::t('auth', 'Updated On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthPermissions()
    {
        return $this->hasMany(AuthPermission::className(), ['rule_id' => 'id']);
    }
}
