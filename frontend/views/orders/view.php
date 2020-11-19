<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Product;
use app\models\Orders;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

if($model->user_id == Yii::$app->user->identity->id){
    $this->title = Product::findOne($model->product_id)->name;
    $this->params['breadcrumbs'][] = ['label' => 'My orders', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="orders-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                ['attribute' => 'order_date', 'format' => 'raw', 'value' => function($data){
                    return date_format(date_create($data->order_date), 'F d, Y - H:i:s');
                }],
                ['label' => 'Unit price','format' => 'raw', 'value' => function($data){
                    return Product::findOne($data->product_id)->price;
                }],
                'quantity',
                'subtotal',
                'total',
                ['label' => 'Amount paid','format' => 'raw', 'value' => function($data){
                    return $data->total-$data->amount_due;
                }],
                'amount_due',
                'ship_to',
                ['attribute' => 'status', 'label' => 'Order status','format' => 'raw', 'value' => function($data){
                    return Orders::getStatus($data->status);
                }],
            ],
        ]) ?>
        <p>
        <?php
            $cancelled = $model->status == Orders::CANCELLED;
            $fully_paid = $model->status == Orders::PAYMENT_COMPLETED;
            $can_cancel = $model->status < Orders::CANCELLED;
            $shipped = $model->status == Orders::IN_TRANSITION;
            $not_shipped_yet = $model->status < Orders::IN_TRANSITION;
            if(!$cancelled && !$fully_paid){
                if($not_shipped_yet){ ?>
                    <?= Html::a('Make a payment', ['/payment/create', 'order' => $model->id], ['class' => 'btn btn-primary']);?>
                    <?= Html::a('Pay on Delivery', ['/orders/ship', 'id' => $model->id], ['class' => 'btn btn-primary']);?><?php
                }
                if($can_cancel){ ?>
                    <?= Html::a('Cancel order', ['cancel', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to cancel this order?',
                        ],
                    ])?>
                <?php ;}
                if($shipped){ ?>
                    <?= Html::a('Confirm order Received', ['/order/receive', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?php ;}
            }
} 
else
    throw new \yii\web\ForbiddenHttpException('You either do not have the rights to view this data or the requested data does not exist'); ?>
</div>