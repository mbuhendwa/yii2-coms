<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Edit Order #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'All Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Order #'.$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
$this->registerJs('
    var unit_price = 0;
    $( document ).ready(function() {
        $("#productid").trigger("change");
    });
    $("#quantity").on("change keyup click", function() {
        $("#subtotal").val($("#quantity").val() * unit_price);
        $("#total").val($("#subtotal").val());
    });
    $("#productid").on("change", function() {
        $.ajax({
            type: "post",
            url: "index.php?r=product/ajax",
            data: {temp_id : $("#productid").val()},
            success: function(data){
                unit_price = data;
                $("#subtotal").val($("#quantity").val() * unit_price);
                $("#total").val($("#subtotal").val());
            }
        });
    });
');
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update_form', [
        'model' => $model,
    ]) ?>

</div>
