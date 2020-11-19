<?php

namespace app\models;

use Yii;
use app\models\Orders;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $orders_id
 * @property int $user_id
 * @property int $amount
 * @property string $payment_method
 * @property string $payment_date
 *
 * @property Orders $orders
 */
class Payment extends \yii\db\ActiveRecord
{
    const CASH_SALE             = 0;
    const MPESA                 = 1;
    const CASH_ON_DELIVERY      = 2;
    const PAYPAL                = 3;
    const CHEQUE                = 4;

    const MSG_PAYPAL            = 'PayPal';
    const MSG_MPESA             = 'M-Pesa';
    const MSG_CASH_SALE         = 'Cash Sale';
    const MSG_CASH_ON_DELIVERY  = 'Cash on Delivery';
    const MSG_CHEQUE            = 'Cheque';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }
    public static function getPaymentMethod($code)
    {
        switch($code){
            case  Payment::PAYPAL :
                return Payment::MSG_PAYPAL;
                break;
            case  Payment::MPESA :
                return Payment::MSG_MPESA;
                break;
            case  Payment::CASH_ON_DELIVERY :
                return Payment::MSG_CASH_ON_DELIVERY;
                break;
            case  Payment::CASH_SALE :
                return Payment::MSG_CASH_SALE;
                break;
            case  Payment::CHEQUE :
                return Payment::MSG_CHEQUE;
                break;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orders_id', 'user_id', 'amount', 'payment_method'], 'required'],
            [['user_id'], 'integer'],
            [['amount'], 'integer', 'min' => 1],
            [['orders_id'], 'integer', 'min' => 0, 'tooSmall' => 'Select an Order'],

            [['payment_date'], 'safe'],
            [['payment_method'], 'string', 'max' => 255],
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
            'orders_id' => 'Orders ID',
            'user_id' => 'User ID',
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
    }
}
