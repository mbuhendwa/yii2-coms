
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body class="dashboard">
    <div class="row">
        <div class="panel">
            <!--column-1-->
            <div class="col-md-3 col-xs-6" >
                <!-- small box -->
                    <div class="small-box bg-aqua">
                                <div class="inner">
                                    
                                    <p>Home page</p> 
                                </div>
                                <div class="icon">
                                    <i class="ion ion-home"></i>
                                </div>
                                    <a href="<?= \yii\helpers\Url::to(['../../frontend/web/views/index']) ?>" class="small-box-footer">
                                        Homepage <i class="fa fa-home"></i>
                                    </a>
                            
                    </div>    
            </div>
            <div class="col-md-3 col-xs-6" >
                <!-- small box -->
                    <div class="small-box bg-aqua">
                                <div class="inner">
                                    
                                    <p>Manage users</p> 
                                </div>
                                <div class="icon">
                                <i class="icon icon-person"></i>
                                </div>
                                    <a href="<?= \yii\helpers\Url::to(['user/index']) ?>" class="small-box-footer">
                                         Users <i class="fa fa-users"></i>
                                    </a>
                            
                    </div>    
            </div>
            <div class="col-md-3 col-xs-6" >
                <!-- small box -->
                    <div class="small-box bg-aqua">
                                <div class="inner">
                                    
                                    <p> payments</p> 
                                </div>
                                <div class="icon">
                                    <i class="ion ion-home"></i>
                                </div>
                                    <a href="<?= \yii\helpers\Url::to(['payment/index']) ?>" class="small-box-footer">
                                    View Payments <i class="fa fa-Paypal"></i>
                                    </a>
                            
                    </div>    
            </div>
            <div class="col-md-3 col-xs-6" >
                <!-- small box -->
                    <div class="small-box bg-aqua">
                                <div class="inner">
                                    
                                    <p>Manage orders</p> 
                                </div>
                                <div class="icon">
                                <i class="icon icon-person"></i>
                                </div>
                                    <a href="<?= \yii\helpers\Url::to(['orders/index']) ?>" class="small-box-footer">
                                         Orders <i class="fa fa-first-order"></i>
                                    </a>
                            
                    </div>    
            </div>
        </div>  
    
    </div>        
    
            



</body>
</html>
