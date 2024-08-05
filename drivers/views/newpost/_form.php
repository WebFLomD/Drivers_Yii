<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Newpost $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="newpost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_new')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'photo_new')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_new')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content_new')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'date_register_new_post')->textInput() ?>

<!--    --><?php //= $form->field($model, 'viewed_new_post')->textInput() ?>

<!--    --><?php //= $form->field($model, 'like_new_post')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_category')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
