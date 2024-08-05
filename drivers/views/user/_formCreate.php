<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="block-auth-register">
    <div class="auth-register-left-input">
        <p class="title-auth-register"><?= Html::encode($this->title) ?></p>

        <?php $form = ActiveForm::begin(); ?>

        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Введите ваш логин</p>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'input-auth-register']) ?>
        </div>

        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Введите ФИО</p>
            <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'class' => 'input-auth-register']) ?>
        </div>

        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Введите ваш телефона</p>
<!--            <input type="tel" id="phone-register" class="input-auth-register" placeholder = "+7 (___) ___-__-__">-->
            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                'mask' => '+7 (999) 999-99-99',
                'options' =>['maxlength' => true ,
                    'class' => 'input-auth-register',
                    'id' => 'phone-register',
                    'placeholder' => '+7 (___) ___-__-__'],
            ]) ?>
        </div>

        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Введите ваш Email</p>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'input-auth-register', 'placeholder' => 'your_mail@gmail.com']) ?>
        </div>

        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Ввыберите Город</p>
            <?= $form->field($model, 'id_cite')->dropDownList(ArrayHelper::map($cites, 'id', 'name_cite'),['class' => 'input-auth-register']) ?>
        </div>

        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Придумайте пароль</p>
            <div class="paasword">
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class' => 'input-auth-register', 'id' => 'password-input']) ?>
                <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
            </div>
            <!-- <input type="password" class="input-auth-register"> -->
        </div>


        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Подтвердить пароль</p>
            <div class="paasword">
                <?= $form->field($model, 'passwordRepeat')->passwordInput(['maxlength' => true, 'class' => 'input-auth-register', 'id' => 'passwordRepeat-input']) ?>
                <a href="#" class="password-control" onclick="return show_hide_passwordRepeat(this);"></a>
            </div>
            <!-- <input type="password" class="input-auth-register"> -->
        </div>

        <div class="input-auth-register-checkbox">
            <?= $form->field($model, 'check')->checkbox([
                'class' => 'custom-checkbox',
            ]) ?>
<!--            <label for="check">Согласен на обр.персон данных</label>-->
        </div>

        <div class="btn-register">
            <button>Создать</button>
<!--            --><?php //= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <!-- <a href="#" class="test">Забыли пароль?</a> -->
    </div>
    <div class="auth-register-right-photo">
        <img src="../all_img/logo_order/fon-reg.jpg" alt="fon">
    </div>
</div>
