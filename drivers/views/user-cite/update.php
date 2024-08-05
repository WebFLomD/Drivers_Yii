<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserCite $model */

$this->title = 'Редактировать город: ' . $model->name_cite;
$this->params['breadcrumbs'][] = ['label' => 'User Cites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-cite-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
