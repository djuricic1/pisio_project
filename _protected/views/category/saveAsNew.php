<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = 'Save As New Category: '. ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
