<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = "Ошибка #".Html::encode($exception->statusCode);

// Ассоциативный массив с переводами сообщений
$translations = [
    'Page not found' => 'Страница не найдена',
    'An internal server error occurred.' => 'Произошла внутренняя ошибка сервера.',
    'You are not allowed to perform this action.' => 'Вам не разрешается выполнять это действие.',
    'Page not found.' => 'Страница не найдена.',
    'The requested post does not exist.' => 'Запрашиваемая запись не существует.',
    'Unable to verify your data submission.' => 'Не удалось подтвердить отправку ваших данных.',
    // Добавьте другие переводы здесь
];

// Функция для перевода сообщения
function translate($message, $translations) {
    return isset($translations[$message]) ? $translations[$message] : $message;
}
?>
<div class="site-error" style="text-align: center">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger" style="font-size: 18px;">
        <?= nl2br(Html::encode(translate($message, $translations))) ?>
    </div>

    <img src="/all_img/error/1.png" style="width: 550px">
    <p style="font-size: 18px;">
        Вышеуказанная ошибка произошла во время обработки веб-сервером вашего запроса.
    </p>
    <p style="font-size: 18px;">
        Пожалуйста, свяжитесь с нами, если вы считаете, что это ошибка сервера. Спасибо!
    </p>

</div>
