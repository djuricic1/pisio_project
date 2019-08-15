<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Person', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Person'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'jmbg',
        'title',
        'contact',
        'employment',
        'role_name',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerFixedAssets->totalCount){
    $gridColumnFixedAssets = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'number',
        'status',
        'description',
        'purchaseDate',
        'initialPrice',
        'amortization',
                [
                'attribute' => 'category.name',
                'label' => 'Category'
            ],
        [
                'attribute' => 'room.name',
                'label' => 'Room'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerFixedAssets,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Fixed Assets'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnFixedAssets
    ]);
}
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
                'attribute' => 'fixedAssets.id',
                'label' => 'Fixed Assets'
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
