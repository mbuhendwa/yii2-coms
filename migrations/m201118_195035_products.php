<?php

use yii\db\Schema;
use yii\db\Migration;

class m201118_195035_products extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            'product',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull()->unique(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('product');
    }
}
