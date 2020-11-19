<?php

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Product;
use app\models\Orders;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['disabled' => 'readonly', 'id' => 'userid', 'placeholder' => 'Search customers ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Customer name');?>

    <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Product::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['disabled' => 'readonly', 'id' => 'productid', 'placeholder' => 'Search items ...', 'readonly' => 'true'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Item');?>

    <?= $form->field($model, 'quantity')->textInput(['readonly' => 'true', 'id' => 'quantity', 'type' => 'number', 'min' => 1, 'value' => $model->quantity]) ?>

    <?= $form->field($model, 'subtotal')->textInput(['readonly' => 'true', 'id' => 'subtotal']) ?>

    <?= $form->field($model, 'total')->textInput(['readonly' => 'true', 'id' => 'total']) ?>
    
    <?= $form->field($model, 'amount_due')->textInput(['readonly' => 'true']) ?>
    
    <?= $form->field($model, 'ship_to')->textInput(['readonly' => 'true']) ?>
    
    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' => array(Orders::AWAITING_PAYMENT => Orders::MSG_AWAITING_PAYMENT,
                        Orders::PAYMENT_STARTED => Orders::MSG_PAYMENT_STARTED,
                        Orders::PAYMENT_COMPLETED => Orders::MSG_PAYMENT_COMPLETED,
                        Orders::AWAITING_SHIPMENT => Orders::MSG_AWAITING_SHIPMENT,
                        Orders::IN_TRANSITION => Orders::MSG_IN_TRANSITION,
                        Orders::COMPLETED => Orders::MSG_COMPLETED,
                        Orders::CANCELLED => Orders::MSG_CANCELLED),
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
