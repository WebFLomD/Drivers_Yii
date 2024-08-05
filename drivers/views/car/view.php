<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Car $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="car-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_car',
            'photo_car_1',
            'photo_car_2',
            'photo_car_3',
            'id_user',
            'id_bodywork',
            'id_transmission_car',
            'id_color',
            'id_drive_car',
            'id_brand_car',
            'id_engine_car',
            'modification_car',
            'id_owners',
            'id_pts',
            'id_year_of_release',
            'id_type_of_car',
            'id_used_or_new',
            'price',
            'mileage',
            'comments_user:ntext',
            'views_post',
            'date_of_registration_post_car',
            'id_status',
        ],
    ]) ?>

</div>
