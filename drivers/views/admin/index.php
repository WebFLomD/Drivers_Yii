<?php

use yii\helpers\Url;

$this -> title = "Панель администратора";
?>

<div class="index-admin">
    <h1>Панель администратора (<?= Yii::$app->user->identity->username; ?>)</h1>
    <div class="btn-admin">
        <a href="<?= Url::toRoute(['/admin/index-user']) ?>">Управление аккаунтами</a>
        <a href="<?= Url::toRoute(['/admin/index-post-admin']) ?>">Управление объявлениями</a>
        <a href="<?= Url::toRoute(['/admin/index-brand-car']) ?>">Управление брендами</a>
        <a href="<?= Url::toRoute(['/admin/index-user-cite']) ?>">Управление города</a>
    </div>
</div>
