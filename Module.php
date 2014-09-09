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

        // custom initialization code goes here
    }
    
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['auth'] = [
           'class' => 'yii\i18n\PhpMessageSource',
           'sourceLanguage' => '',
           'basePath' => '@idwaker/auth/messages',
           
           // 'fileMap' => [
//                'auth' => 'auth.php'
//            ] 
        ];
    }
}
