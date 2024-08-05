<?php

use yii\helpers\Url;

$this->title = 'Управление городами'
?>
<div class="block-table">

    <div class="table-admin">
        <div class="add-btn-title-admin">
            <h1><?= $this->title ?></h1>
            <a href="/user-cite/create" title="Добавить бренд"><i class="fa-solid fa-plus"></i></a>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>№</th>
                <th>Наименование</th>
                <th>Управление</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cites as $cite):?>
                <tr>
                    <td><?= $cite -> id?></td>
                    <td><?= $cite -> name_cite?></td>
                    <td style="width: auto;">
                        <div class="td-btn" style="display: flex">
                            <form action="<?= Url::toRoute(['/user-cite/delete', 'id' => $cite->id]) ?>" method="post" title="Удалить">
                                <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer; font-size: 16px" class = "btn-admin-management">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <form action="<?= Url::toRoute(['/user-cite/update', 'id' => $cite->id]) ?>" method="post" title="Редактировать">
                                <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer; font-size: 16px" class = "btn-admin-management">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </form>
                        </div>

                    </td>
                </tr>
            <?php endforeach;?>

            </tbody>
        </table>
    </div>
</div>