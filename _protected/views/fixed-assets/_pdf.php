<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\FixedAssets */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fixed Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fixed-assets-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Fixed Assets'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'status',
        'description',
        'purchaseDate',
        'initialPrice',
        'amortization',
        [
                'attribute' => 'person.name',
                'label' => 'Person'
            ],
        [
                'attribute' => 'category.name',
                'label' => 'Category'
            ],
        [
                'attribute' => 'room.name',
                'label' => 'Room'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerTransfer->totalCount){
    $gridColumnTransfer = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'dateCreated',
                [
                'attribute' => 'personIdFrom0.name',
                'label' => 'PersonIdFrom'
            ],
        [
                'attribute' => 'personIdTo0.name',
                'label' => 'PersonIdTo'
            ],
        [
                'attribute' => 'roomIdFrom0.name',
                'label' => 'RoomIdFrom'
            ],
        [
                'attribute' => 'roomIdTo0.name',
                'label' => 'RoomIdTo'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerTransfer,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Transfer'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnTransfer
    ]);
}
?>
    </div>
</div>
