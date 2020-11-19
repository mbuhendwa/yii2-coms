<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\jui\DatePicker;

use app\models\Product;
use app\models\Payment;
use app\models\Orders;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'orders_id', 'label' => 'Order','format' => 'raw', 'value' => function($data){
                $temp_order = Orders::findOne($data->orders_id);
                $temp_product = Product::findOne($temp_order->product_id);
                return Html::a($temp_order->quantity.'*'.$temp_product->name, Url::to(['payment/view', 'id' => $data->id]));
            }],
            'amount',
            ['attribute' => 'payment_method', 'format' => 'raw', 'value' => function($data){
                switch($data->payment_method){
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
            }],
            'payment_date',
        ],
    ]); ?>
</div>
