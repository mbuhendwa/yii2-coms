<?php

use yii\db\Schema;
use yii\db\Migration;

class m201118_203244_orders extends Migration
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
            'orders',
            [
                'id'=> $this->pk()->comment('Order ID'),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
