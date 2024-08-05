<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block-auth-register">
    <div class="auth-register-left-input">
        <p class="title-auth-register"><?= Html::encode($this->title) ?></p>

        <?php $form = ActiveForm::begin(); ?>

        <!-- Поле ввода "Логин" -->
        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Введите логин/почту</p>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'input-auth-register']) ?>
        </div>

        <!-- Поле ввода "Пароль" -->
        <div class="input-auth-register-block">
            <p class="title-text-auth-register">Введите пароль</p>
            <div class="paasword">
                <?= $form->field($model, 'password')->passwordInput(['class' => 'input-auth-register', 'id' => 'password-input']) ?>
                <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
            </div>
        </div>

        <!-- Чек-бокс "Запомнить меня" -->
        <div class="input-auth-register-checkbox">
            <?= $form->field($model, 'rememberMe')->checkbox([
                'class' => 'custom-checkbox',
            ]) ?>
            <label for="check">Запомнить меня</label>
        </div>

        <!-- Кнопка "Войти" -->
        <div class="btn-auth">
            <button>Войти</button>
        </div>

        <?php ActiveForm::end(); ?>

        <!-- Кнопка "Регистрация" -->
        <div class="btn-register">
            <button onclick="window.location.href = '<?= Url::toRoute(['/user/create'])?>';">Зарегистрироваться</button>
        </div>


        <!-- <a href="#" class="test">Забыли пароль?</a> -->
    </div>
    <div class="auth-register-right-photo">
        <img src="../all_img/logo_order/fon.jpeg" alt="fon">
    </div>
</div>