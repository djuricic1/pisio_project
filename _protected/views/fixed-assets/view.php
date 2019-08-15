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
        <div class="col-sm-8">
            <h2><?= 'Fixed Assets'.' '. Html::encode($this->title) ?></h2>
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
        'status',
        'description',
        'purchaseDate',
        'initialPrice',
        'amortization',
        [
            'attribute' => 'person.name',
            'label' => 'Person',
        ],
        [
            'attribute' => 'category.name',
            'label' => 'Category',
        ],
        [
            'attribute' => 'room.name',
            'label' => 'Room',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Category<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCategory = [
        ['attribute' => 'id', 'visible' => false],
        'name',
    ];
    echo DetailView::widget([
        'model' => $model->category,
        'attributes' => $gridColumnCategory    ]);
    ?>
    <div class="row">
        <h4>Person<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    if($model->person != null) {
    $gridColumnPerson = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'jmbg',
        'title',
        'contact',
        'employment',
        'role_name',
    ];
    echo DetailView::widget([
        'model' => $model->person,
        'attributes' => $gridColumnPerson    ]);
    }
    else {
        echo "<p> This asset has no owner. </p>";
    }
    ?>
    <div class="row">
        <h4>Room<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    if($model->room != null) {
    $gridColumnRoom = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'name',
        'building_id',
    ];
    echo DetailView::widget([
        'model' => $model->room,
        'attributes' => $gridColumnRoom    ]);
    }
    else {
        echo "<p> This asset has no room. </p>";
    }
    
    ?>
   
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
