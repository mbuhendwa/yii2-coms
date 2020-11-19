
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
</head>
<body>
<div class="row">
<div class="panel">
    <div class="col-md-3 col-xs-6" >
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>
                    <?= YII_ENV ?>
                </h3>

                <p>
                    Go to Frontend
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-home"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to('../../frontend/views/site/main') ?>" class="small-box-footer">
                Homepage <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
        </div>    
    </div>
    <!-- ./col -->


    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    n/a
                </h3>

                <p>
                    Users
                </p>
            </div>
            <div class="icon">
                <i class="icon ion-person"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['/user/index']) ?>" class="small-box-footer">
                Manage users<i class="fa fa-users"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>
                    <?= count(\Yii::$app->getModules()) ?>
                </h3>

                <p>
                    Modules
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to(['/debug']) ?>" class="small-box-footer">
                Debug <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>
    <!-- ./col -->

    <div class="col-md-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    <?= getenv('APP_VERSION') ?>
                </h3>

                <p>
                    Version
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-grid"></i>
            </div>
            <a href="<?= \yii\helpers\Url::to('http://phundament.com') ?>" target="_blank" class="small-box-footer">
                Phundament Online <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->

</div>

<div class="row">
    <div class="col-sm-12">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Languages</h3>
            </div>
            <div class="box-body">
                Test
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <small>Registered in <code>urlManager</code> application component.</small>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>

</div>


<div class="row">
    <div class="col-sm-6">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Modules</h3>
            </div>
            <div class="box-body">
                <?php
                foreach (\Yii::$app->getModules() AS $name => $m) {
                    $module = \Yii::$app->getModule($name);
                    echo yii\helpers\Html::a(
                        $module->id,
                        ['/'.$module->id],
                        ['class' => 'btn btn-default btn-flat']
                    );
                }
                ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <small>Registered in application from configuration or bootstrapping.</small>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-sm-6">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Documentation</h3>
            </div>
            <div class="box-body">
                <div class="alert alert-info">
                    <i class="fa fa-warning"></i>
                    <b>Notice!</b> Use the <i>yii2-apidoc</i> extension to
                    create the HTML documentation for this application.
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </div>
</div>

<?= $this->render('_expand-collapse') ?>



</body>
</html>
