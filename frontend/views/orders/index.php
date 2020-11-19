<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Product;
use app\models\Orders;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Place order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'product_id', 'label' => 'Item','format' => 'raw', 'value' => function($data){
                return Html::a(Product::findOne($data->product_id)->name, Url::to(['orders/view', 'id' => $data->id]));
            }],
            ['attribute' => 'product_id', 'label' => 'Unit price','format' => 'raw', 'value' => function($data){
                return Product::findOne($data->product_id)->price;
            }],
            'quantity',
            'subtotal',
            'total',
            ['attribute' => 'amount_due', 'label' => 'Amount paid', 'format' => 'raw', 'value' => function($data){
                return $data->total - $data->amount_due;
            }],
            'amount_due',
            ['attribute' => 'status', 'label' => 'Order status','format' => 'raw', 'value' => function($data){
                return Orders::getStatus($data->status);
            }],
            'ship_to',
            ['attribute' => 'order_date', 'label' => 'Order date','format' => 'raw', 'value' => function($data){
                return date_format(date_create($data->order_date), 'F d, Y - H:i:s');
            }],
        ],
    ]); ?>
</div>
