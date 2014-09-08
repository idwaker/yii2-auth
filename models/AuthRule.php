<?php

namespace idwaker\auth\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;


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
    public function getAuthPermissions()
    {
        return $this->hasMany(AuthPermission::className(), ['rule_id' => 'id']);
    }
}
