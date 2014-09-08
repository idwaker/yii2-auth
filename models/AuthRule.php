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
     * @return \yii\db\ActiveQuery
     */
    public function getAuthPermissions()
    {
        return $this->hasMany(AuthPermission::className(), ['rule_id' => 'id']);
    }
}
