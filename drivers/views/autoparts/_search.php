<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\AutopartsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="autoparts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title_auto_parts') ?>

    <?= $form->field($model, 'photo_auto_parts') ?>

    <?= $form->field($model, 'id_сondition_auto_parts') ?>

    <?= $form->field($model, 'id_originality_auto_parts') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_manufacturer') ?>

    <?php // echo $form->field($model, 'part_number') ?>

    <?php // echo $form->field($model, 'id_for_models') ?>

    <?php // echo $form->field($model, 'id_product_availability') ?>

    <?php // echo $form->field($model, 'price_auto_parts') ?>

    <?php // echo $form->field($model, 'comments_user') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, 'views_auto_parts') ?>

    <?php // echo $form->field($model, 'date_of_registration_auto_parts') ?>

    <?php // echo $form->field($model, 'id_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
