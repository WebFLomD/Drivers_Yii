<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\CarSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="car-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_car') ?>

    <?= $form->field($model, 'photo_car_1') ?>

    <?= $form->field($model, 'photo_car_2') ?>

    <?= $form->field($model, 'photo_car_3') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_bodywork') ?>

    <?php // echo $form->field($model, 'id_transmission_car') ?>

    <?php // echo $form->field($model, 'id_color') ?>

    <?php // echo $form->field($model, 'id_drive_car') ?>

    <?php // echo $form->field($model, 'id_brand_car') ?>

    <?php // echo $form->field($model, 'id_engine_car') ?>

    <?php // echo $form->field($model, 'modification_car') ?>

    <?php // echo $form->field($model, 'id_owners') ?>

    <?php // echo $form->field($model, 'id_pts') ?>

    <?php // echo $form->field($model, 'id_year_of_release') ?>

    <?php // echo $form->field($model, 'id_type_of_car') ?>

    <?php // echo $form->field($model, 'id_used_or_new') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, 'comments_user') ?>

    <?php // echo $form->field($model, 'views_post') ?>

    <?php // echo $form->field($model, 'date_of_registration_post_car') ?>

    <?php // echo $form->field($model, 'id_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
