<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\NewpostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="newpost-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title_new') ?>

    <?= $form->field($model, 'photo_new') ?>

    <?= $form->field($model, 'description_new') ?>

    <?= $form->field($model, 'content_new') ?>

    <?php // echo $form->field($model, 'date_register_new_post') ?>

    <?php // echo $form->field($model, 'viewed_new_post') ?>

    <?php // echo $form->field($model, 'like_new_post') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_category') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
