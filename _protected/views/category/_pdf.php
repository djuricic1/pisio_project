<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Category'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
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
</div>
