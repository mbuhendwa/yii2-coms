<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

use yii2assets\printthis\PrintThis;

use app\models\Product;
use app\models\Orders;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = Product::findOne($model->product_id)->name;
$this->params['breadcrumbs'][] = ['label' => 'All Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
    $('#deliveryNoteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
    ", \yii\web\View::POS_READY);
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update Order', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Remove Order', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                
            ],
            
        ]) ?>
        <?= Html::a('Generate PDF', ['gen-pdf', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

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
                return Orders::getStatus($data->status);
            }],
        ],
        
    ]); ?>
 
</div>
            <?php
            $can_cancel = $model->status < Orders::PAYMENT_STARTED;
            $cancelled = $model->status == Orders::CANCELLED;
            $fully_paid = $model->status == Orders::PAYMENT_COMPLETED;
            $shipped = $model->status == Orders::IN_TRANSITION;
            if(!$cancelled && !$fully_paid){ ?>
                <?= Html::a('Make a payment', ['/payment/create', 'order' => $model->id], ['class' => 'btn btn-primary']);?>
                <?= Html::a('Pay on Delivery', ['/orders/ship', 'order' => $model->id], ['class' => 'btn btn-primary']);?><?php
                if($shipped){ ?>
                    <a data-toggle="modal", data-target="#deliveryNoteModal", class="btn btn-primary btn-md" 
                        href="<?= Url::to(['note', 'id' => $model->id, ]) ?>">
                        <i class="fa fa-print"></i> <?= 'Delivery Note' ?>
                    </a><?php
                }
            }
Modal::begin([
    'header' => 'Delivery Note',
    'id' => 'deliveryNoteModal',
    'closeButton' => [
        'label' => 'Close',
        'class' => 'btn btn-danger btn-sm pull-right',
    ],
    'footer' => PrintThis::widget([
        "htmlOptions" => [
            "id" => "note-layout",
            "btnClass" => "btn btn-success",
            "btnId" => "btnPrintThis",
            "btnText" => "Print Note",
            "btnIcon" => "fa fa-print", 
            "class" => "btn btn-success",
        ],
        "options" => [
            "debug" => false,
            "importCSS" => true,
            "importStyle" => true,
            "pageTitle" => "Delivery Note",
            "removeInline" => false,
            "printDelay" => 333,
            "header" => null,
            "formValues" => true,
        ]
    ]),
    'size' => 'modal-md',
]);
Modal::end();
?>

</div>