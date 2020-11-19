<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Create Orders';
$this->params['breadcrumbs'][] = ['label' => 'All Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
<div class="orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create_form', [
        'model' => $model,
    ]) ?>

</div>
