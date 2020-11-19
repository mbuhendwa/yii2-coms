<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'All Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'username',
            'phone',
            'shipping_address',
            'email:email',
            ['attribute' => 'role', 'label' => 'Role','format' => 'raw', 'value' => function($data){
                return $data->role == 0 ? 'Customer' : 'Admin';
            }],
            ['attribute' => 'created_at', 'label' => 'Created on','format' => 'raw', 'value' => function($data){
                return  date('F d, Y - H:i:s', $data->created_at);
            }],
            ['attribute' => 'updated_at', 'label' => 'Last Updated on','format' => 'raw', 'value' => function($data){
                return  date('F j, Y - H:i:s', $data->updated_at);
            }],
        ],
    ]) ?>

</div>
