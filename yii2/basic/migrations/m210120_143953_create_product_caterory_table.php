<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_caterory}}`.
 */
class m210120_143953_create_product_caterory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_caterory}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_caterory}}');
    }
}
