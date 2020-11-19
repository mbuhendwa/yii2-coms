<?php

use yii\db\Schema;
use yii\db\Migration;

class m201118_195035_orders_searches extends Migration
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
