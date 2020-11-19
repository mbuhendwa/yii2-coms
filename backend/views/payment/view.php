<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\Payment;
use app\models\Product;
use app\models\Orders;
use common\models\User;
use app\models\View_pdf;





use yii\bootstrap\Modal;
use yii2assets\printthis\PrintThis;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'Payment #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
    $('#receiptModal').on('show.bs.modal', function (event) {
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
<div class="payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <a data-toggle="modal", data-target="#receiptModal", class="btn btn-primary btn-md" 
            href="<?= Url::to(['receipt', 'id' => $model->id, ]) ?>">
            <i class="fa fa-print"></i> <?= 'View Receipt' ?>
        </a>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
<?php
Modal::begin([
    'header' => 'Receipt',
    'id' => 'receiptModal',
    'closeButton' => [
        'label' => 'Close',
        'class' => 'btn btn-danger btn-sm pull-right',
    ],
    'footer' => PrintThis::widget([
        "htmlOptions" => [
            "id" => "receipt-layout",
            "btnClass" => "btn btn-success",
            "btnId" => "btnPrintThis",
            "btnText" => "Print Receipt",
            "btnIcon" => "fa fa-print", 
            "class" => "btn btn-success",
        ],
        "options" => [
            "debug" => false,
            "importCSS" => true,
            "importStyle" => true,
            "pageTitle" => "Receipt",
            "removeInline" => false,
            "printDelay" => 333,
            "header" => null,
            "formValues" => true,
        ]
    ]),
    'size' => 'modal-lg',
]);
Modal::end();
?>
</div>
