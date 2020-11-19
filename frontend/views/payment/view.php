<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Payment;

/* @var $this yii\web\View */
/* @var $model app\models\Payment */
if($model->user_id == Yii::$app->user->identity->id){
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'orders_id',
            'amount',
            ['attribute' => 'payment_method','format' => 'raw', 'value' => function($data){
                switch ($data->payment_method) {
                    case Payment::PAYPAL :
                        return Payment::MSG_PAYPAL;
                        break;
                    case Payment::MPESA :
                        return Payment::MSG_MPESA;
                        break;
                    case Payment::CASH_ON_DELIVERY :
                        return Payment::MSG_CASH_ON_DELIVERY;
                        break;
                    case Payment::CHEQUE :
                        return Payment::MSG_CHEQUE;
                        break;
                        
                        if(isset($_POST['viewreceipt'])){
                        header("Location: ViewRecept.php"); 
                        exit;
                        }
                }
            }],
            'payment_date' ,
            
        ],
    ]) ?>

</div><?php

}
else throw new \yii\web\ForbiddenHttpException('You either do not have the rights to view this data or the requested data does not exist');



