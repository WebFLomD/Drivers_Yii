<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Autoparts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="autoparts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_auto_parts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_auto_parts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_condition_auto_parts')->textInput() ?>

    <?= $form->field($model, 'id_originality_auto_parts')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_manufacturer')->textInput() ?>

    <?= $form->field($model, 'part_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_for_models')->textInput() ?>

    <?= $form->field($model, 'id_product_availability')->textInput() ?>

    <?= $form->field($model, 'price_auto_parts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments_user')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'mileage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'views_auto_parts')->textInput() ?>

    <?= $form->field($model, 'date_of_registration_auto_parts')->textInput() ?>

    <?= $form->field($model, 'id_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
