<?php

namespace app\models;
use common\models\User;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property int $quantity
 * @property int $subtotal
 * @property int $total
 * @property int $amount_due
 * @property string $order_date
 *
 * @property int $status
 * @property int $ship_to
 * 
 * @property Product $product
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    const AWAITING_PAYMENT          = 0;
    const CANCELLED                 = 5;
    const PAYMENT_STARTED           = 10;
    const PAYMENT_COMPLETED         = 13;
    const AWAITING_SHIPMENT         = 15;
    const IN_TRANSITION             = 20;
    const COMPLETED                 = 30;
    
    const MSG_AWAITING_PAYMENT      = 'Awaiting Payment';
    const MSG_PAYMENT_STARTED       = 'Awaiting Full Payment';
    const MSG_PAYMENT_COMPLETED     = 'Paid Fully';
    const MSG_AWAITING_SHIPMENT     = 'Awaiting Shipment';
    const MSG_IN_TRANSITION         = 'Shipped';
    const MSG_COMPLETED             = 'Completed';
    const MSG_CANCELLED             = 'Cancelled';
    const MSG_PENDING               = 'Pending';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }
    public static function getStatus($code = Orders::AWAITING_PAYMENT)
    {
        switch ($code) {
            case Orders::AWAITING_PAYMENT   : return '<b>'.Orders::MSG_AWAITING_PAYMENT.'</b>'; break;
            case Orders::PAYMENT_STARTED    : return '<b>'.Orders::MSG_PAYMENT_STARTED.'</b>'; break;
            case Orders::PAYMENT_COMPLETED  : return '<b>'.Orders::MSG_PAYMENT_COMPLETED.'</b>'; break;
            case Orders::AWAITING_SHIPMENT  : return '<b>'.Orders::MSG_AWAITING_SHIPMENT.'</b>'; break;
            case Orders::IN_TRANSITION      : return '<b>'.Orders::MSG_IN_TRANSITION.'</b>'; break;
            case Orders::COMPLETED          : return '<b><font color="green">'.Orders::MSG_COMPLETED.'</font></b>'; break;
            case Orders::CANCELLED          : return '<b><font color="red">'.Orders::MSG_CANCELLED.'</font></b>'; break;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'quantity', 'subtotal','ship_to', 'total'], 'required'],
            [['product_id', 'user_id', 'quantity', 'subtotal', 'total', 'status', 'amount_due'], 'integer'],

            ['user_id', 'default', 'value' => \Yii::$app->user->identity['id']],
            ['ship_to', 'default', 'value' => \Yii::$app->user->identity['shipping_address']],
            ['status', 'default', 'value' => 0],
            ['order_date', 'default', 'value' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])],
            
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Order ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'quantity' => 'Quantity',
            'subtotal' => 'Subtotal',
            'ship_to' => 'Ship to',
            'amount_due' => 'Amount due',
            'total' => 'Total',
            'order_date' => 'Order Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
