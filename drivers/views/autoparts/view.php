<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Autoparts $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Autoparts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="autoparts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title_auto_parts',
            'photo_auto_parts',
            'id_сondition_auto_parts',
            'id_originality_auto_parts',
            'id_user',
            'id_manufacturer',
            'part_number',
            'id_for_models',
            'id_product_availability',
            'price_auto_parts',
            'comments_user:ntext',
            'mileage',
            'views_auto_parts',
            'date_of_registration_auto_parts',
            'id_status',
        ],
    ]) ?>

</div>
