<?php

use yii\db\Schema;
use yii\db\Migration;

class m201118_203244_products extends Migration
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
                'id'=> $this->pk()->comment(''),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('product');
    }
}
