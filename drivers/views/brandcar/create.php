<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Brandcar $model */

$this->title = 'Добавление бренда';
$this->params['breadcrumbs'][] = ['label' => 'Brandcars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brandcar-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
