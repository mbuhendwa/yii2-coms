<?php

use yii\db\Schema;
use yii\db\Migration;

class m201118_195035_payments extends Migration
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
            'payment',
            [
                'id'=> $this->pk()->comment('ID'),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('payment');
    }
}
