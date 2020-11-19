<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Payment;
use common\models\User;
use app\models\Orders;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop; 


/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(User::find()->where(['role' => 0])->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['id' => 'userid', 'placeholder' => 'Search customers ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Customer name');?>

        <?= $form->field($model, 'orders_id')->widget(DepDrop::classname(), [
        'options' => ['id'=>'ordersid'],
        'pluginOptions'=>[
            'depends'=>['userid'],
            'placeholder' => 'Select...',
            'url' => Url::to(['/orders/ajax'])
        ]
    ]) ?>
    
    <?php // Html::activeDropDownList($model, 'orders_id',
     //ArrayHelper::map(Orders::find()->where(['user_id' => $model->orders_id]), 'orders_id', 'id')) ?>

    <?= $form->field($model, 'amount')->textInput(['id' => 'amount']) ?>
    
    <font id="amount_error" color="#A94442" hidden></font>
    
    <?= $form->field($model, 'payment_method')->widget(Select2::classname(), [
           'data' => array( Payment::PAYPAL=>Payment::MSG_PAYPAL,
                            Payment::MPESA=>Payment::MSG_MPESA,
                            Payment::CASH_SALE=>Payment::MSG_CASH_SALE,
                            Payment::CASH_ON_DELIVERY=>Payment::MSG_CASH_ON_DELIVERY,
                            Payment::CHEQUE=>Payment::MSG_CHEQUE),

            'language' => 'en',
            'pluginOptions' => [
               'allowClear' => true     
             ], 
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['id' => 'save_payment_btn', 'class' => 'btn btn-success']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>
    
    </div>
