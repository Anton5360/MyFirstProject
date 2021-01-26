<?php

use yii\db\Expression;
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
            'product_id' => $this->integer()->notNull(),
            'url' => $this->string(255)->notNull()->unique(),
            'is_main' => $this->boolean()->notNull()->defaultValue(false),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP'))
        ]);

        $this->addForeignKey(
            'fk-products_images-product_id-products-id',
            '{{%products_images}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-products_images-product_id-products-id', '{{%products_images}}');
        $this->dropTable('{{%products_images}}');
    }
}
