<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FixedAssets */

$this->title = 'Update Fixed Assets: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fixed Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fixed-assets-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
