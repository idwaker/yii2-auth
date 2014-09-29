<?php

use yii\db\Schema;
use yii\db\Migration;


/**
 * Initialises auth module
 * Tables: user, role, permission, rule
 */
class m010101_010101_init_auth extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('auth_permission', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(64) NOT NULL UNIQUE',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'permission_id' => Schema::TYPE_INTEGER . '(11)',
            'rule_id' => Schema::TYPE_INTEGER . '(11)',
            'created_on' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_on' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('fk_auth_permission_parent', 'auth_permission', 'parent',
                             'auth_permission', 'id', 'SET NULL', 'NO ACTION');

        $this->createTable('auth_role', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(64) NOT NULL UNIQUE',
            'description' => Schema::TYPE_TEXT,
            'role_id' => Schema::TYPE_INTEGER . '(11)',
            'created_on' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_on' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_auth_role_parent', 'auth_role', 'parent',
                             'auth_role', 'id', 'SET NULL', 'NO ACTION');

        $this->createTable('auth_rule', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(64) NOT NULL UNIQUE',
            'data' => Schema::TYPE_TEXT,
            'created_on' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_on' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);
        
        $this->addForeignKey('fk_auth_permission_rule_id', 'auth_permission', 'rule_id',
                             'auth_rule', 'id', 'SET NULL', 'NO ACTION');

        $this->createTable('auth_user', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . '(64) NOT NULL',
            'auth_key' => Schema::TYPE_TEXT . ' NOT NULL',
            'password' => Schema::TYPE_STRING . '(64) NOT NULL',
            'secret_key' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 1',
            'is_loggedin' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
            'last_loggedin' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_on' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_on' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);
        
        $this->createIndex('username_unique', 'auth_user', ['username'],
                            true);

        $this->createTable('auth_role_permission', [
            'role_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'permission_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_auth_role_permission_role_id',
                             'auth_role_permission', 'role_id', 'auth_role',
                             'id', 'CASCADE', 'NO ACTION');

        $this->addForeignKey('fk_auth_role_permission_permission_id',
                             'auth_role_permission', 'permission_id',
                             'auth_permission', 'id', 'CASCADE', 'NO ACTION');

        $this->addPrimaryKey('pk_auth_role_permission', 'auth_role_permission',
                             ['role_id', 'permission_id']);

        $this->createTable('auth_user_role', [
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'role_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_auth_user_role_user_id',
                             'auth_user_role', 'user_id', 'auth_user',
                             'id', 'CASCADE', 'NO ACTION');

        $this->addForeignKey('fk_auth_user_role_role_id',
                             'auth_user_role', 'role_id',
                             'auth_role', 'id', 'CASCADE', 'NO ACTION');

        $this->addPrimaryKey('pk_auth_user_role', 'auth_user_role',
                             ['user_id', 'role_id']);
    }

    public function safeDown()
    {
        $this->dropTable('auth_role_permission');
        $this->dropTable('auth_user_role');
        $this->dropTable('auth_user');
        $this->dropTable('auth_rule');
        $this->dropTable('auth_role');
        $this->dropTable('auth_permission');
    }
}
