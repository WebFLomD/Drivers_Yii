<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Autoparts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="block-create-car">
    <div class="car-create-left-input">
        <p class="title-car-create"><?= Html::encode($this->title) ?></p>

        <?php $form = ActiveForm::begin(); ?>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите название</p>
            <?= $form->field($model, 'title_auto_parts')->textInput(['maxlength' => true, 'class' => 'input-all-car-create'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Состояние</p>
            <?= $form->field($model, 'id_condition_auto_parts')->dropDownList(ArrayHelper::map($condition, 'id', 'name'),['class' => 'input-all-car-create'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Оригинальность</p>
            <?= $form->field($model, 'id_originality_auto_parts')->dropDownList(ArrayHelper::map($originality, 'id', 'name'),['class' => 'input-all-car-create'])->label(false) ?>
        </div>

<!--        <div class="input-car-create">-->
<!--            <p class="text-all-car-create">Выберите цвет</p>-->
<!--            --><?php //= $form->field($model, 'id_for_models')->dropDownList(ArrayHelper::map($for_models, 'id', 'name') ,['class' => 'input-all-car-create'])->label(false) ?>
<!--        </div>-->

        <div class="input-car-create">
            <p class="text-all-car-create">Производитель</p>
            <?= $form->field($model, 'id_manufacturer')->dropDownList(ArrayHelper::map($manufacturer, 'id', 'name') ,['class' => 'input-all-car-create'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Наличие товара</p>
            <?= $form->field($model, 'id_product_availability')->dropDownList(ArrayHelper::map($product_availability ,'id', 'name'), ['class' => 'input-all-car-create'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите номер</p>
            <?= $form->field($model, 'part_number')->textInput(['maxlength' => true, 'class' => 'input-all-car-create'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите пробег (Если новая, ставьте 0)</p>
            <?= $form->field($model, 'mileage')->textInput(['maxlength' => true, 'class' => 'input-all-car-create'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите стоимость (в рублях)</p>
            <?= $form->field($model, 'price_auto_parts')->textInput(['maxlength' => true, 'class' => 'input-all-car-create'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите описание</p>
            <?= $form->field($model, 'comments_user')->textarea(['rows' => 6, 'class' => 'input-all-car-create input-all-car-create-text'])->label(false) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Ввыберите фото</p>
            <?= $form->field($model, 'photo_auto_parts')->fileInput(['class' => 'input-file-car-create'])->label(false) ?>
        </div>


        <div class="btn-car-create">
            <button>Разместить</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
