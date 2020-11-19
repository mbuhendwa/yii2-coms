<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Edit profile';
$this->params['breadcrumbs'][] = ['label' => 'My profile', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit profile';
$this->registerJs('
    $( document ).ready(function() {
        $("#uname_available").hide();
        $("#uname_unavailable").hide();
    });
    $("#uname").on("keyup cut paste", function() {
        $.ajax({
            type: "post",
            url: "index.php?r=user/username",
            data: {temp_uname : $("#uname").val()},
            success: function(data){
                if(data){
                    $("#uname_unavailable").hide();
                    $("#uname_available").show();
                    $("#btn_submit").removeAttr("disabled");
                }
                else{
                    $("#uname_available").hide();
                    $("#uname_unavailable").show();
                    $("#btn_submit").attr("disabled", "disabled");
                }
            }
        });
    });
');
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
