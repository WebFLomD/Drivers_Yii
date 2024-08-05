<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Autoparts $model */

$this->title = 'Update Autoparts: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Autoparts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="autoparts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
