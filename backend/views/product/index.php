<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventory';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('New Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'name', 'label' => 'Item','format' => 'raw', 'value' => function($data){
                return Html::a($data->name, Url::to(['product/view', 'id' => $data->id]));
            }],
            ['attribute' => 'price', 'label' => 'Unit price (Ksh)'],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
