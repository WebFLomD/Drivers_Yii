<?php

use app\models\Car;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\CarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Car', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_car',
            'photo_car_1',
            'photo_car_2',
            'photo_car_3',
            //'id_user',
            //'id_bodywork',
            //'id_transmission_car',
            //'id_color',
            //'id_drive_car',
            //'id_brand_car',
            //'id_engine_car',
            //'modification_car',
            //'id_owners',
            //'id_pts',
            //'id_year_of_release',
            //'id_type_of_car',
            //'id_used_or_new',
            //'price',
            //'mileage',
            //'comments_user:ntext',
            //'views_post',
            //'date_of_registration_post_car',
            //'id_status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Car $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
