Yii2 Auth Module with RBAC
==========================
This uses Yii2 RBAC Interface with simple to understand tablenames and uses AR models.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist idwaker/yii2-auth "*"
```

or add

```
"idwaker/yii2-auth": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \idwaker\auth\AutoloadExample::widget(); ?>```