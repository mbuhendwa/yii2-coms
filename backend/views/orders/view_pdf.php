<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Product;
use app\models\Orders;
use common\models\User;
use app\models\mPDF;

use yii2mod\receipt\Receipt;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>


    <h1> Competa Ltd</br>P O Box4251-00100</br>Mobile no:+254771386569</br>E-mail:competa@info.ke</Br>Nairobi</br>Ngong lane, Jadala Place 5th flr</h1>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #fff none;
            font-size: 12px;
        }
        address {
            margin-top: 8px;
            <margin-left: 350px;
        }
        h2 {
            font-size: 28px;
            color: #cccccc;
        }
        .container {
            padding-top: 30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }
        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }
    </style>
    </head>
    <body>
    <div class="container">
    <table style="margin-left: auto; margin-right: auto" width="550">
        <tr>
            <td width="160">
                &nbsp;
            </td>

            <!-- Organization Name / Image -->
            <td align="right">
                
            </td>
        </tr>
        <tr valign="top">
            <td style="font-size:28px;color:#cccccc;">
               Competa Ltd Receipt
                
            </td>

            <!-- Organization Name / Date -->
            <td>
                <br><br>
                
                <br>
                
            </td>
        </tr>
</body>
</html>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?>Receipt</h1>
   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'user_id', 'label' => 'Customer name','format' => 'raw', 'value' => function($data){
                return User::findOne($data->user_id)->name;
            }],
            ['attribute' => 'order_date', 'format' => 'raw', 'value' => function($data){
                return date_format(date_create($data->order_date), 'F d, Y - H:i:s');
            }],
            ['attribute' => 'product_id', 'label' => 'Item','format' => 'raw', 'value' => function($data){
                return Product::findOne($data->product_id)->name;
            }],
            'quantity',
            ['label' => 'Unit price','format' => 'raw', 'value' => function($data){
                return Product::findOne($data->product_id)->price;
            }],
            'subtotal',
            'total',
            ['label' => 'Amount paid','format' => 'raw', 'value' => function($data){
                return $data->total - $data->amount_due;
            }],
            'amount_due',
            'ship_to',
            ['attribute' => 'status', 'label' => 'Order status','format' => 'raw', 'value' => function($data){
                switch ($data->status) {
                    case Orders::AWAITING_PAYMENT :
                        return Orders::MSG_PENDING.'<i><b>'.Orders::MSG_AWAITING_PAYMENT.'</i></b>';
                        break;
                    case Orders::PAYMENT_STARTED :
                        return Orders::MSG_PENDING.'<i><b>'.Orders::MSG_PAYMENT_STARTED.'</i></b>';
                        break;
                    case Orders::PAYMENT_COMPLETED :
                        return Orders::MSG_PENDING.'<i><b>'.Orders::MSG_PAYMENT_COMPLETED.'</i></b>';
                        break;
                    case Orders::AWAITING_SHIPMENT :
                        return Orders::MSG_PENDING.'<i><b>'.Orders::MSG_AWAITING_SHIPMENT.'</i></b>';
                        break;
                    case Orders::IN_TRANSITION :
                        return Orders::MSG_PENDING.'<i><b>'.Orders::MSG_IN_TRANSITION.'</i></b>';
                        break;
                    case Orders::COMPLETED :
                        return '<font color="green">'.Orders::MSG_COMPLETED.'</font>';
                        break;
                    case Orders::CANCELLED :
                        return '<font color="red">'.Orders::MSG_CANCELLED.'</font>';
                        break;
                }
                return '<font color="red"><i>'.Orders::MSG_UNKNOWN.'</i></font>';
            }],
        ],
        
    ]); ?>
 <link rel="stylesheet" type="text/css" media="print" href="print.css">
 <ul class="button" data-role="print">
                                                    
                                
                                <li><a href="print_preview.php">Print</a></li>
                                
                            </ul>
 </div>
            