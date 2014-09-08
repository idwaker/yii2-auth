<?php

namespace idwaker\auth\models;

use idwaker\auth\models\AuthPermission;


class Permission extends AuthPermission
{
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
}