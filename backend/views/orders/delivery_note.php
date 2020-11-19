<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Product;
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
        #note-layout{
            font-family: Consolas, monospace;
            background-color:powderblue ;
            width: 300px;
            padding-top: 35px;
            padding-bottom: 35px;
            padding-left: 15px;
            padding-right: 15px;
            margin: 0px auto;
        }
        #note-header{
            text-align: center;
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
<div id="note-layout">
    <div id="note-header">
        <label id="logo-name">YiiMart</label><br>
        P.O. Box 30100-2500, Eldoret<br>
        Tel: +254727005131<br>
        Email: support@yiimart.co.ke<br>
        Website: yiimart.co.ke<br>
        Yii Kenya Ltd.<br><hr>
    </div>
    <?php
        $prod = Product::findOne($model->product_id);
        $client = User::findOne($model->user_id);
        $vat = 0;
    ?>
    <div id="note-details">
    <table>
        <tr><td id="left">Order ID:   </td><td id="right"><?= $model->id?></td></tr>
        <tr><td id="left">Item:       </td><td id="right"><?= $prod->name ?></td></tr>
        <tr><td id="left">Unit Price: </td><td id="right"><?= $prod->price ?></td></tr>
        <tr><td id="left">Quantity:   </td><td id="right"><?= $model->quantity ?></td></tr>
        <tr><td id="left">Subtotal:   </td><td id="right"><?= $model->subtotal ?></td></tr>
        <tr><td id="left">VAT:        </td><td id="right"><?= $vat ?></td></tr>
        <tr><td id="left">Total:      </td><td id="right"><?= $model->total ?></td></tr>
    </table>
    </div><hr>
    <div id="note-due">
    <table>
        <tr><td id="left">Already Paid:      </td><td id="right"><?= $model->total-$model->amount_due ?></td></tr>
        <tr><td id="left">To be paid on delivery:</td><td id="right"><?= $model->amount_due ?></td></tr>
        <tr><td id="left">Amount received:</td><td id="right">......</td></tr>
    </table>
    </div><hr>
    <div id="note-footer">
    <table>
        <tr><td id="left">Delivery Address:</td><td id="right"><?= $model->ship_to ?></td></tr>
        <tr><td id="left">Delivered to:</td><td id="right"><?= $client->name ?></td></tr>
        <tr><td id="left">Phone:</td><td id="right"><?= $client->phone ?></td></tr>
        <tr><td id="left">Signature:</td><td id="right">.......................</td></tr>
        <tr><td id="left">Delivery Date:</td><td id="right"><?= date('jS F Y', $_SERVER['REQUEST_TIME']) ?></td></tr>
    </table>
    </div>
</div>