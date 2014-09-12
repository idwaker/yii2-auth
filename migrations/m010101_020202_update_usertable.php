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
    }

    public function safeDown()
    {
        $this->dropColumn('auth_user', 'secret_key');
        $this->alterColumn('auth_user', 'auth_key',
                           Schema::TYPE_STRING . '(32) NOT NULL');
    }
}
