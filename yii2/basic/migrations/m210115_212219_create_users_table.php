<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210115_212219_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull(),
            'login' => $this->string(20)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'is_active' => $this->boolean()->defaultValue(false)->notNull(),
            'created_at' => $this->timestamp()->defaultValue(new Expression('CURRENT_TIMESTAMP'))->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
