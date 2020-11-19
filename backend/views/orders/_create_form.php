<?php

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Product;
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
        'options' => ['id' => 'userid', 'placeholder' => 'Search customers ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Customer name');?>

    <?= $form->field($model, 'product_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Product::find()->all(), 'id', 'name'),
        'language' => 'en',
        'options' => ['id' => 'productid', 'placeholder' => 'Search items ...', 'readonly' => 'true'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Item');?>

    <?= $form->field($model, 'quantity')->textInput(['id' => 'quantity', 'type' => 'number', 'min' => 1, 'value' => 1]) ?>

    <?= $form->field($model, 'subtotal')->textInput(['readonly' => 'true', 'id' => 'subtotal']) ?>

    <?= $form->field($model, 'total')->textInput(['readonly' => 'true', 'id' => 'total']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
