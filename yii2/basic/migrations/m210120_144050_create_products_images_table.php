<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_images}}`.
 */
class m210120_144050_create_products_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_images}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_images}}');
    }
}
