<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Регистрация';
?>
<div class="user-create">

    <?= $this->render('_formCreate', [
        'model' => $model,
        'cites' => $cites,
    ]) ?>

</div>
