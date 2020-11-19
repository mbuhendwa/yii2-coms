<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['id' => 'uname', 'maxlength' => true]) ?>
    
    <font id="uname_available" color="green" hidden>Username available</font>
    <font id="uname_unavailable" color="red" hidden>Username unavailable</font>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'shipping_address')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['id' => 'btn_submit', 'class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
