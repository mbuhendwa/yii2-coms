<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Payment;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orders_id')->textInput(['readonly' => 'true', 'value' => Yii::$app->request->get('order')]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'payment_method')->widget(Select2::classname(), [
        'data' => array(Payment::PAYPAL => Payment::MSG_PAYPAL,
                        Payment::MPESA => Payment::MSG_MPESA,
                        Payment::CASH_SALE => Payment::MSG_CASH_SALE,
                        Payment::CASH_ON_DELIVERY => Payment::MSG_CASH_ON_DELIVERY,
                        Payment::CHEQUE => Payment::MSG_CHEQUE),
                        
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
