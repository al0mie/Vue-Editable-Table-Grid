<?php

use Phinx\Migration\AbstractMigration;

class UserTableMigration extends AbstractMigration
{
    /**
     * Run migration
     */
    public function up()
    {
        $users = $this->table('users');
        $users->addColumn('username', 'string', array('limit' => 120))
            ->addColumn('email', 'string', array('limit' => 40))
            ->addColumn('first_name', 'string', array('limit' => 30))
            ->addColumn('last_name', 'string', array('limit' => 30))
            ->addColumn('address', 'string', array('limit' => 230))
            ->addIndex(array('username', 'email'), array('unique' => true))
            ->save();
    }

    /**
     * Roll back migration
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
