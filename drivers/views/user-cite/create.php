<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserCite $model */

$this->title = 'Добавить город';
$this->params['breadcrumbs'][] = ['label' => 'User Cites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-cite-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
