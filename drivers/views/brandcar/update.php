<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Brandcar $model */

$this->title = 'Редактировать бренд: ' . $model->name;
$this->params['breadcrumbs'][] = 'Редактировать бренд';
?>
<div class="brandcar-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
