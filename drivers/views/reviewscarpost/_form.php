<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Reviewscarpost $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reviewscarpost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_reviews')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_reviews')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content_reviews')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_register_reviews')->textInput() ?>

    <?= $form->field($model, 'viewed_reviews')->textInput() ?>

    <?= $form->field($model, 'like_reviews')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_category_reviews')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
