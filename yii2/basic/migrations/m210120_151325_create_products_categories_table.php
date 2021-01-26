<?php

use yii\db\Expression;
use yii\db\Migration;


class m210120_151325_create_products_categories_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%products_categories}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_categories}}');
    }
}
