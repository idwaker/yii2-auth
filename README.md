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

Work in progress, unstable.

Structure
---------

    Module.php
    README.md
    components/
        AuthManager.php
    models/
        User.php
        Role.php
        Permission.php
        Rule.php
        RolePermission.php
        UserRole.php
        UserIdentity.php
    controllers/
        UserController.php
        RoleControler.php
        PermissionController.php
        RuleController.php
    commands/
        AuthController.php
    migrations/
        ...
    views/
        user/
            ...
        role/
            ...
        permission/
            ...
        rule/
            ...