<?php

use app\models\Role;
use app\models\User;
use app\models\UserCite;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление аккаунтами';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block-table">

    <div class="table-admin">
        <h1><?= $this->title ?></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>ФИО</th>
                    <th>Логин</th>
                    <th>Телефон</th>
                    <th>Почта</th>
                    <th>Город</th>
                    <th>Дата рождения</th>
                    <th>Дата регистрации</th>
                    <th>Роль</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user):?>
                <tr>
                    <td><?= $user -> id?></td>
                    <td><?= $user -> fio?></td>
                    <td><?= $user -> username?></td>
                    <td><?= $user -> phone?></td>
                    <td><?= $user -> email?></td>
                    <td><?= UserCite::findOne($user->id_cite) -> name_cite?></td>
                    <td><?=$user->date_of_birth !== null ? Yii::$app->formatter->asDate($user->date_of_birth, 'php:d.m.Y') : '-' ?></td>
                    <td><?=$user->date_of_registration !== null ? Yii::$app->formatter->asDate($user->date_of_registration, 'php:d.m.Y') : '-' ?></td>
                    <td><?= Role::findOne($user->id_role)-> name ?></td>
                    <td>
                        <form action="<?= Url::toRoute(['/user/delete', 'id' => $user->id]) ?>" method="post" title="Удалить">
                            <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                            <button type="submit" style="background:none; border:none; padding:0; cursor:pointer; font-size: 16px">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>

            </tbody>
        </table>
    </div>
</div>
