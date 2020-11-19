<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Payment;
use app\models\Orders;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

?>
<head>
    <style>
        hr { border-color: black }
        table { width: 100% }
        #logo-name {
            font-size: x-large;
            font-weight: 1000;
        }
        #receipt-layout{
            font-family: Consolas, monospace;
            background-color:powderblue ;
            width: 750px;
            padding-top: 35px;
            padding-bottom: 35px;
            padding-left: 15px;
            padding-right: 15px;
            margin: 0px auto;
        }
        #receipt-header{
            text-align: left;
        }
        #left{
            text-align: left;
            vertical-align: top;
            font-weight: 700;
        }
        #right{
            text-align: right;
            vertical-align: bottom;
        }
    </style>
</head>
<div id="receipt-layout">
    <table>
        <tr>
            <td id="left"><div id="receipt-header">
                <label id="logo-name">YiiMart</label><br>
                P.O. Box 30100-2500, Eldoret<br>
                Tel: +254727005131<br>
                Email: support@yiimart.co.ke<br>
                Website: yiimart.co.ke<br>
                Yii Kenya Ltd.<br>
            </div></td>
            <td id="right"><div>
                Receipt Number: <?= $model->id?><br>
                Date: <?= date('jS F Y', $_SERVER['REQUEST_TIME']) ?></div>
            </td>
        </tr>
    </table><hr>
    <?php
        $client = User::findOne($model->user_id);
        $vat = 0;
    ?>
    <div id="receipt-details">
    <table>
        <tr><td id="left">Order ID:             </td><td id="right"><?= $model->orders_id?></td></tr>
        <tr><td id="left">Amount (in figures):  </td><td id="right">Ksh<?= $model->amount ?></td></tr>
        <tr><td id="left">Amount (in words):    </td><td id="right">...........................................................................</td></tr>
        <tr><td id="left">Paid by:              </td><td id="right"><?= $client->name ?></td></tr>
        <tr><td id="left">Payment Method:       </td><td id="right"><?= Payment::getPaymentMethod($model->payment_method) ?></td></tr>
    </table>
    </div><hr>
    <div id="receipt-footer">
    <table>
        <tr></td><td id="right">Signature:........................................</td></tr>
    </table>
    </div>
</div>