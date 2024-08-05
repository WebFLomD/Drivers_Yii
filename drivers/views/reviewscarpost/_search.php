<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\ReviewscarpostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reviewscarpost-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'photo_reviews') ?>

    <?= $form->field($model, 'description_reviews') ?>

    <?= $form->field($model, 'content_reviews') ?>

    <?php // echo $form->field($model, 'date_register_reviews') ?>

    <?php // echo $form->field($model, 'viewed_reviews') ?>

    <?php // echo $form->field($model, 'like_reviews') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_category_reviews') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
