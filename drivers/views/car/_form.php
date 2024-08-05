<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Car $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_car')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_car_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_car_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_car_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_bodywork')->textInput() ?>

    <?= $form->field($model, 'id_transmission_car')->textInput() ?>

    <?= $form->field($model, 'id_color')->textInput() ?>

    <?= $form->field($model, 'id_drive_car')->textInput() ?>

    <?= $form->field($model, 'id_brand_car')->textInput() ?>

    <?= $form->field($model, 'id_engine_car')->textInput() ?>

    <?= $form->field($model, 'modification_car')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_owners')->textInput() ?>

    <?= $form->field($model, 'id_pts')->textInput() ?>

    <?= $form->field($model, 'id_year_of_release')->textInput() ?>

    <?= $form->field($model, 'id_type_of_car')->textInput() ?>

    <?= $form->field($model, 'id_used_or_new')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mileage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments_user')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'views_post')->textInput() ?>

    <?= $form->field($model, 'date_of_registration_post_car')->textInput() ?>

    <?= $form->field($model, 'id_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
