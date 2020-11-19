<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */

$this->title = 'Create Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs('
    var max_amount, obj;
    $("#userid").on("change", function() {
        $.ajax({
            type: "post",
            url: "index.php?r=orders/ajax",
            data: {userid : $("#userid").val()},
            success: function(data){
                obj = JSON.parse(data);
                for(var i in obj){
                    if(obj[parseInt(i)] == 0) delete obj[parseInt(i)];
                }
                $("#ordersid").empty();
                $("#ordersid").append($("<option>", {
                    value:  -1,
                    text: "--Select Order--"
                }));
                if(max_amount && parseInt($("#amount").val()) > max_amount){
                    $("#amount_error").html("Select an order first");
                    $("#amount_error").show();
                    $("#save_payment_btn").attr("disabled", "disabled");
                }
                for(var i in obj) {
                    var option = document.createElement("option");
                    $("#ordersid").append($("<option>", {
                        value:  i,
                        text: "Order #" + i
                    }));
                }
            }
        });
    });
    $("#ordersid").on("change", function() {
        if($("#ordersid").val() != -1){
            max_amount = obj[parseInt($("#ordersid").val())];
            $("#amount").trigger("change");
            // $("#ordersid option:selected").text();
        }
    });
    $("#amount").on("change keyup paste", function() {
        if(parseInt($("#amount").val()) > max_amount){
            $("#amount_error").html("Amount cannot exceed " + max_amount);
            $("#amount_error").show();
            $("#save_payment_btn").attr("disabled", "disabled");
        }
        else{
            $("#amount_error").hide();
            $("#save_payment_btn").removeAttr("disabled");
        }
    });
');
?>
<div class="payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
