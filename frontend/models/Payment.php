<?php

namespace app\models;

use Yii;
use app\models\Orders;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $orders_id
 * @property int $amount
 * @property int $payment_method
 * @property string $payment_date
 *
 * @property int $user_id
 * 
 * @property Orders $orders
 */
class Payment extends \yii\db\ActiveRecord
{
    const PAYPAL = 3;
    const MPESA = 1;
    const CASH_ON_DELIVERY =2;
    const CASH_SALE =2;
    const CHEQUE = 4;

    const MSG_PAYPAL = 'PayPal';
    const MSG_MPESA = 'M-Pesa';
    const MSG_CASH_SALE = 'Cash Sale';
    const MSG_CASH_ON_DELIVERY = 'Cash on Delivery';
    const MSG_CHEQUE = 'Cheque';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id','user_id', 'amount', 'payment_method'], 'required'],
            [['orders_id','user_id', 'payment_method'], 'integer'],
            ['payment_date', 'default', 'value' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])],
            ['user_id', 'default', 'value' => Yii::$app->user->identity['id']],
            [['amount'], 'integer', 'max' => Orders::findOne(Yii::$app->request->get('order'))->amount_due, 'min' => 1],
            [['orders_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['orders_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orders_id' => 'Order #',
            'user_id' => 'Customer',
            'amount' => 'Amount',
            'payment_method' => 'Payment Method',
            'payment_date' => 'Payment Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['id' => 'orders_id']);
        return $this->hasOne(orders::className(),['amount'=> 'total']);
    }
}
