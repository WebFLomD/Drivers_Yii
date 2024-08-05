<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Newpost $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="block-create-new">
    <div class="new-create-left-input">
        <p class="title-new-create"><?= Html::encode($this->title) ?></p>

        <?php $form = ActiveForm::begin(); ?>

        <div class="input-new-create">
            <p class="text-all-new-create">Введите название поста</p>
            <?= $form->field($model, 'title_new')->textInput(['maxlength' => true, 'class' => 'input-all-new-create']) ?>
        </div>

        <div class="input-new-create">
            <p class="text-all-new-create">Выберите категорию</p>
            <?= $form->field($model, 'id_category')->dropDownList(ArrayHelper::map($categoryPosts, 'id', 'name_category'), ['class' => 'input-all-new-create']) ?>
        </div>

        <div class="input-new-create">
            <p class="text-all-new-create">Напишите контент</p>
            <?= $form->field($model, 'content_new')->textInput(['maxlength' => true, 'class' => 'input-all-new-create']) ?>
        </div>

        <div class="input-new-create">
            <p class="text-all-new-create">Напишите текст</p>
            <?= $form->field($model, 'description_new')->textarea(['rows' => 6, 'class' => 'input-all-new-create input-all-new-create-text']) ?>
        </div>

        <div class="input-new-create">
            <p class="text-all-new-create">Ввыберите фото (Если без фото, просто пропустите)</p>
            <?= $form->field($model, 'photo_new')->fileInput(['class' => 'input-file-new-create']) ?>
        </div>


        <div class="btn-new-create">
            <button>Опубликовать</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>