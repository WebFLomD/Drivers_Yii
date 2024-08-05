<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
?>
<div class="post-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Likes: <?= $model->getLikesCount() ?>
        <?php if (!$model->userHasLikedPost(Yii::$app->user->id)): ?>
            <?= Html::a('Like', ['like', 'postId' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php else: ?>
            <?= Html::a('Unlike', ['unlike', 'postId' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php endif; ?>
    </p>
</div>