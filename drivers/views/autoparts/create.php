<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Autoparts $model */

$this->title = 'Продать АвтоЗапчасти';
?>
<div class="autoparts-create">

    <?= $this->render('_formCreate', [
        'model' => $model,
        'condition' => $condition,
        'originality' => $originality,
        'manufacturer' => $manufacturer,
//        'for_models' => $for_models,
        'product_availability' => $product_availability,
    ]) ?>

</div>
