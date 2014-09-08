<?php

namespace idwaker\auth\models;

use idwaker\auth\models\AuthRule;


class Rule extends AuthRule
{
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
}