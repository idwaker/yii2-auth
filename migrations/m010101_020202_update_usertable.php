<?php

use yii\db\Schema;
use yii\db\Migration;


/**
 * Initialises auth module
 * Tables: user, role, permission, rule
 */
class m010101_020202_update_usertable extends Migration
{
    public function safeUp()
    {
        $this->addColumn('auth_user', 'secret_key',
                         Schema::TYPE_TEXT . ' NOT NULL');
        $this->alterColumn('auth_user', 'auth_key',
                           Schema::TYPE_TEXT . ' NOT NULL');
        $this->createIndex('username_unique', 'auth_user', ['username'],
                            true);
        $this->renameColumn('auth_role', 'parent', 'role_id');
        $this->renameColumn('auth_permission', 'parent', 'permission_id');
    }

    public function safeDown()
    {
        $this->dropColumn('auth_user', 'secret_key');
        $this->alterColumn('auth_user', 'auth_key',
                           Schema::TYPE_STRING . '(32) NOT NULL');
        $this->dropIndex('username_unique', 'auth_user');
        $this->renameColumn('auth_role', 'role_id', 'parent');
        $this->renameColumn('auth_permission', 'permission_id', 'parent');
    }
}
