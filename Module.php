<?php

namespace idwaker\auth;

use Yii;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'idwaker\auth\controllers';

    public function init()
    {
        parent::init();
        
        $this->registerTranslations();
        
        $this->setAliases([
            $this->alias => __DIR__,
        ]);

        // custom initialization code goes here
    }
    
    public function registerTranslations()
    {
        if (empty(Yii::$app->i18n->translations['auth'])) {
            Yii::$app->i18n->translations['auth'] = [
               'class' => 'yii\i18n\PhpMessageSource',
               // 'sourceLanguage' => '',
               'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}
