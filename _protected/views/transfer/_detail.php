<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Transfer */

?>
<div class="transfer-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
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
</div>