<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Room */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Room', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Room'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'name',
        [
            'attribute' => 'building.name',
            'label' => 'Building',
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
                'attribute' => 'person.name',
                'label' => 'Person'
            ],
            [
                'attribute' => 'category.name',
                'label' => 'Category'
            ],
                ];
    echo Gridview::widget([
        'dataProvider' => $providerFixedAssets,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-fixed-assets']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Fixed Assets'),
        ],
        'columns' => $gridColumnFixedAssets
    ]);
}
?>

    </div>
    <div class="row">
        <h4>Building<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnBuilding = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'name',
        'geoLocation',
    ];
    echo DetailView::widget([
        'model' => $model->building,
        'attributes' => $gridColumnBuilding    ]);
    ?>
    
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
                'attribute' => 'personIdFrom0.name',
                'label' => 'PersonIdFrom'
            ],
            [
                'attribute' => 'personIdTo0.name',
                'label' => 'PersonIdTo'
            ],
                            ];
    echo Gridview::widget([
        'dataProvider' => $providerTransfer,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-transfer']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Transfer'),
        ],
        'columns' => $gridColumnTransfer
    ]);
}
?>

    </div>
</div>
