<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\Product;
use app\models\Orders;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- <?= $this->render('_search', ['model' => $searchModel]); ?> -->

    <p>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'product_id', 'label' => 'Item','format' => 'raw', 'value' => function($data){
                return Html::a(Product::findOne($data->product_id)->name, Url::to(['orders/view', 'id' => $data->id]));
            }],
            ['attribute' => 'user_id', 'label' => 'Customer name','format' => 'raw', 'value' => function($data){
                return User::findOne($data->user_id)->name;
            }],
            'quantity',
            ['attribute' => 'user_id', 'label' => 'Unit price','format' => 'raw', 'value' => function($data){
                return Product::findOne($data->product_id)->price;
            }],
            'subtotal',
            'total',
            ['attribute' => 'amount_due', 'label' => 'Amount paid','format' => 'raw', 'value' => function($data){
                return $data->total - $data->amount_due;
            }],
            'amount_due',
            ['attribute' => 'status', 'label' => 'Order status','format' => 'raw', 'value' => function($data){
                return Orders::getStatus($data->status);
            }],
            'ship_to',
            ['attribute' => 'order_date', 'label' => 'Customer name','format' => 'raw', 'value' => function($data){
                return date_format(date_create($data->order_date), 'F d, Y - H:i:s');
            }],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
