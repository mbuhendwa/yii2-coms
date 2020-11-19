<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add new customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'name', 'label' => 'Item','format' => 'raw', 'value' => function($data){
                return Html::a($data->name, Url::to(['user/view', 'id' => $data->id]));
            }],
            'username',
            'phone',
            'shipping_address',
            'email:email',
            ['attribute' => 'role', 'label' => 'Role','format' => 'raw', 'value' => function($data){
                return $data->role == 0 ? 'Customer' : 'Admin';
            }],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
