<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Newpost $model */

$this->title = 'Создание поста';
?>
<div class="newpost-create">

    <?= $this->render('_formCreate', [
        'model' => $model,
        'categoryPosts' => $categoryPosts,
    ]) ?>

</div>
