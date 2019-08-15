<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Transfer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transfer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= 'Transfer'.' '. Html::encode($this->title) ?></h2>
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
        'dateCreated',
        [
            'attribute' => 'fixedAssets.id',
            'label' => 'Fixed Assets',
        ],
        [
            'attribute' => 'personIdFrom0.name',
            'label' => 'PersonIdFrom',
        ],
        [
            'attribute' => 'personIdTo0.name',
            'label' => 'PersonIdTo',
        ],
        [
            'attribute' => 'roomIdFrom0.name',
            'label' => 'RoomIdFrom',
        ],
        [
            'attribute' => 'roomIdTo0.name',
            'label' => 'RoomIdTo',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>FixedAssets<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnFixedAssets = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'status',
        'description',
        'purchaseDate',
        'initialPrice',
        'amortization',
        'person_id',
        'category_id',
        'room_id',
    ];
    echo DetailView::widget([
        'model' => $model->fixedAssets,
        'attributes' => $gridColumnFixedAssets    ]);
    ?>
    <div class="row">
        <h4>Person<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
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
        'model' => $model->personIdFrom0,
        'attributes' => $gridColumnPerson    ]);
    ?>
    <div class="row">
        <h4>Person<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
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
        'model' => $model->personIdTo0,
        'attributes' => $gridColumnPerson    ]);
    ?>
    <div class="row">
        <h4>Room<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnRoom = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'name',
        'building_id',
    ];
    echo DetailView::widget([
        'model' => $model->roomIdFrom0,
        'attributes' => $gridColumnRoom    ]);
    ?>
    <div class="row">
        <h4>Room<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnRoom = [
        ['attribute' => 'id', 'visible' => false],
        'number',
        'name',
        'building_id',
    ];
    echo DetailView::widget([
        'model' => $model->roomIdTo0,
        'attributes' => $gridColumnRoom    ]);
    ?>
</div>
