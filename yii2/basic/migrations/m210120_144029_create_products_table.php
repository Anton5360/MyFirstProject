<?php

use yii\db\Expression;
use yii\db\Migration;


class m210120_144029_create_products_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'price' => $this->decimal(10,2)->notNull(),
            'slug' => $this->string(255)->notNull()->unique(),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP'))
        ]);

        $this->addForeignKey(
            'fk-products-category_id-products_categories-id',
            '{{%products}}',
            'category_id',
            '{{%products_categories}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('fk-products-category_id-products_categories-id', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
