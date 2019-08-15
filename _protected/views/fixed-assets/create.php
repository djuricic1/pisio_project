<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FixedAssets */

$this->title = 'Create Fixed Assets';
$this->params['breadcrumbs'][] = ['label' => 'Fixed Assets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fixed-assets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
