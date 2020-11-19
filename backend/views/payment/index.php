<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Payment;
use app\models\Orders;
use app\models\Product;
use common\models\User;
use app\model\Pdf;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
            ['attribute' => 'user_id', 'label' => 'Customer','format' => 'raw', 'value' => function($data){
                return User::findOne($data->user_id)->name;
            }],
            'amount',
            ['attribute' => 'payment_method', 'format' => 'raw', 'value' => function($data){
                return Payment::getPaymentMethod($data->payment_method);
            }],
            'payment_date',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
