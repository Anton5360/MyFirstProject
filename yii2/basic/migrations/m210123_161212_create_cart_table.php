<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m210123_161212_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'user_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey(
            'fk-cart-user_id-users-id',
            '{{%cart}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cart-product_id-products-id',
            '{{%cart}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addPrimaryKey(
            'pk-cart-user_id-product_id',
            '{{%cart}}',
            ['user_id', 'product_id']
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('fk-cart-user_id-users-id','{{%cart}}');
        $this->dropForeignKey('fk-cart-product_id-products-id','{{%cart}}');
        $this->dropPrimaryKey('pk-cart-user_id-product_id','{{%cart}}');
        $this->dropTable('{{%cart}}');
    }
}
