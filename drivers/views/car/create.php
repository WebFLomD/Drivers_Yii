<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Car $model */

$this->title = 'Продать транспорт';
$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create">


    <?= $this->render('_formCreate', [
        'model' => $model,

        'bodywork' => $bodywork,
        'transmission_car' => $transmission_car,
        'color' => $color,
        'drive_car' => $drive_car,
        'brand_car' => $brand_car,
        'engine_car' => $engine_car,
        'pts' => $pts,
        'year_of_release' => $year_of_release,
        'type_of_car' => $type_of_car,
        'owners' => $owners,
        'used_or_new' => $used_or_new,
    ]) ?>

</div>
