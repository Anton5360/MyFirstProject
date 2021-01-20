<?php

use yii\db\Migration;

/**
 * Class m210119_191532_rename_column_name_users
 */
class m210119_191532_rename_column_name_users extends Migration
{

    public function safeUp()
    {
        $this->renameColumn('users', 'name', 'username');
    }


    public function safeDown()
    {
        $this->renameColumn('users','username','name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210119_191532_rename_column_name_users cannot be reverted.\n";

        return false;
    }
    */
}
