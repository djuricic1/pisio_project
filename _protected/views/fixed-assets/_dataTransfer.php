<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->transfers,
        'key' => 'id'
    ]);
    $gridColumns = [
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
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'transfer'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
