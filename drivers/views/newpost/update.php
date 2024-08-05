<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Newpost $model */

$this->title = 'Update Newpost: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Newposts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="newpost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
