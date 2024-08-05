<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Brandcar $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="block-create-car">
    <div class="car-create-left-input">
        <p class="title-car-create"><?= Html::encode($this->title) ?></p>

        <?php $form = ActiveForm::begin(); ?>

        <div class="input-car-create">
            <p class="text-all-car-create">Введите название авто</p>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'input-all-car-create']) -> label(false) ?>
        </div>

        <div class="btn-car-create">
            <button>Сохранить</button>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
