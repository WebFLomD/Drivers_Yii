<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Радактировать профиль: ' . $model->username;
?>
<div class="user-update">

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'cites' => $cites,
    ]) ?>

</div>
