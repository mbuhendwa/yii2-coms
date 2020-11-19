<?php

use yii\db\Migration;
use yii\db\Transaction;
use common\models\User;

/**
 * Class m201119_002458_create_admin_user
 */
class m201119_002458_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */    
    public function safeUp()
    {
        $transaction = $this->getDb()->beginTransaction();
        $user = \Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'create',
            'email'    => 'admin@example.com',
            'username' => 'admin',
            'role'     => 1,
            'name'     => 'Admin Admin',
            'phone'     => '12345667',
            'shipping_address' => "23 Rue de l'Admin, 23e arr, Paris",
            'password' => 'adminpwd',
        ]);
        $user->auth_key = Yii::$app->getSecurity()->generateRandomString();
        if (!$user->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        // $user->confirm();
        $transaction->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201119_002458_create_admin_user cannot be reverted.\n";

        return false;
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201119_002458_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
