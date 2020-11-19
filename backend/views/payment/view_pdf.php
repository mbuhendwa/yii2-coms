  
<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Payment;
use app\models\Product;
use app\models\Orders;
use common\models\User;

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
<div class="payment-view">

    <h1><?= Html::encode($this->title) ?>Receipt</h1>
<div class="well">
     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'orders_id',
            ['label' => 'Order details', 'format' => 'raw', 'value' => function($data){
                $temp_order = Orders::findOne($data->orders_id);
                $temp_product = Product::findOne($temp_order->product_id);
                return $temp_product->name.' ('.$temp_order->quantity.')';
            }],
            ['attribute' => 'user_id', 'label' => 'Customer','format' => 'raw', 'value' => function($data){
                return User::findOne($data->user_id)->name;
            }],
            'amount',
                       
            ['attribute'=> 'payment_method','format'=>'raw', 'value'=> function($data) { 
                switch($data->payment_method){            
                case Payment::PAYPAL:
                return Payment::MSG_PAYPAL;
                break;
                case Payment::MPESA:
                return Payment::MSG_MPESA;
                break;
                case Payment::CASH_ON_DELIVERY:
                return Payment::MSG_CASH_ON_DELIVERY;
                break;
                case Payment::CHEQUE:
                return Payment::MSG_CHEQUE;
                break;
                case Payment::CASH_SALE:
                return Payment::MSG_CASH_SALE;
                break;
            }
        }],
            'payment_date',
    ],
    ]) ?>
    </div>
    <link rel="stylesheet" type="text/css" media="print" href="print.css">
 <ul class="button" data-role="print">
                                                    
                                
                                <li><a href="print_preview.php">Print</a></li>
                                
                            </ul>
</div><?php



