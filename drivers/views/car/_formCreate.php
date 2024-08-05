<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Car $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="block-create-car">
    <div class="car-create-left-input">
        <p class="title-car-create"><?= Html::encode($this->title) ?></p>

        <?php $form = ActiveForm::begin(); ?>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите название авто</p>
            <?= $form->field($model, 'name_car')->textInput(['maxlength' => true, 'class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите кузов</p>
            <?= $form->field($model, 'id_bodywork')->dropDownList(ArrayHelper::map($bodywork, 'id', 'name'),['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите коробку</p>
            <?= $form->field($model, 'id_transmission_car')->dropDownList(ArrayHelper::map($transmission_car, 'id', 'name'),['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите цвет</p>
            <?= $form->field($model, 'id_color')->dropDownList(ArrayHelper::map($color, 'id', 'name') ,['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите привод</p>
            <?= $form->field($model, 'id_drive_car')->dropDownList(ArrayHelper::map($drive_car ,'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите марку</p>
            <?= $form->field($model, 'id_brand_car')->dropDownList(ArrayHelper::map($brand_car ,'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите двигатель</p>
            <?= $form->field($model, 'id_engine_car')->dropDownList(ArrayHelper::map($engine_car ,'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите модификацию авто (л.с.)</p>
            <?= $form->field($model, 'modification_car')->textInput(['maxlength' => true, 'class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите количество владельцов</p>
            <?= $form->field($model, 'id_owners')->dropDownList(ArrayHelper::map($owners , 'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите ПТС</p>
            <?= $form->field($model, 'id_pts')->dropDownList(ArrayHelper::map($pts , 'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите год выпуска</p>
            <?= $form->field($model, 'id_year_of_release')->dropDownList(ArrayHelper::map($year_of_release , 'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите тип транспорта</p>
            <?= $form->field($model, 'id_type_of_car')->dropDownList(ArrayHelper::map($type_of_car , 'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Выберите состояние авто</p>
            <?= $form->field($model, 'id_used_or_new')->dropDownList(ArrayHelper::map($used_or_new , 'id', 'name'), ['class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите пробег</p>
            <?= $form->field($model, 'mileage')->textInput(['maxlength' => true, 'class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите стоимость (в рублях)</p>
            <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите описание авто</p>
            <?= $form->field($model, 'comments_user')->textarea(['rows' => 6, 'class' => 'input-all-car-create']) ?>
        </div>

        <div class="input-car-create">
            <p class="text-all-car-create">Ввыберите фото</p>
            <?= $form->field($model, 'photo_car_1')->fileInput(['class' => 'input-file-car-create']) ?>
            <?= $form->field($model, 'photo_car_2')->fileInput(['class' => 'input-file-car-create']) ?>
            <?= $form->field($model, 'photo_car_3')->fileInput(['class' => 'input-file-car-create']) ?>
        </div>


        <div class="btn-car-create">
            <button>Разместить</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>