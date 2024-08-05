<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="block-update-user">
    <div class="update-user-left-input">
        <p class="title-update-user"><?= Html::encode($this->title) ?></p>

        <?php $form = ActiveForm::begin(); ?>
        <div class="img-user-avatar">
            <img id="selected-image" src="<?= $model -> getImageUser() ?>">
        </div>
        <div class="input-update-user">
            <p class="text-all-update-user">Логин</p>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'input-all-update-user']) ?>
        </div>
        <div class="input-update-user">
            <p class="text-all-update-user">ФИО</p>
            <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'class' => 'input-all-update-user']) ?>
        </div>
        <div class="input-update-user">
            <p class="text-all-update-user">Почта</p>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'input-all-update-user']) ?>
        </div>
        <div class="input-update-user">
            <p class="text-all-update-user">Телефон</p>
            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                'mask' => '+7 (999) 999-99-99',
                'options' =>['maxlength' => true ,
                    'class' => 'input-all-update-user',
                    'id' => 'phone-register',
                    'placeholder' => '+7 (___) ___-__-__'],
            ]) ?>
        </div>

        <div class="input-update-user">
            <p class="text-all-update-user">Город</p>
            <?= $form->field($model, 'id_cite')->dropDownList(ArrayHelper::map($cites, 'id', 'name_cite'),['class' => 'input-all-update-user']) ?>
        </div>



        <div class="input-update-user">
            <p class="text-all-update-user">Дата рождения</p>
            <?= $form->field($model, 'date_of_birth')->input ('date', ['class'=>'input-all-update-user']) ?>
        </div>
        <div class="input-update-user">
            <p class="text-all-update-user">Ввыберите фото</p>
            <?= $form->field($model, 'img_user')->fileInput(['class' => 'input-file-update-user', 'onchange' => 'showImage(event)']) ?>
        </div>



        <div class="btn-save-update-user">
            <button>Сохранить</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
