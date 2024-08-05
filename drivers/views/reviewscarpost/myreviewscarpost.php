<?php

use app\models\Category;
use app\models\CategoryReviews;
use app\models\Newpost;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\search\NewpostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Мои отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block-new">
    <div class="block-left-new-btn">
        <div class="block-left-new">
            <div class="title-new">
                <p><?= $this->title ?></p>
            </div>
            <div class="btn-create-new-post">
                <button onclick="window.location.href = '<?= Url::toRoute(['/reviewscarpost/create'])?>';"><i class="fa-solid fa-pen-to-square"></i> Создать Запись</button>
            </div>

            <!--            <div class="my-new-post">-->
            <!--                <button class="btn-my-new-post">-->
            <!--                    <div class="img-user-new">-->
            <!--                        <img src="--><?php //= $users->getImageUser()?><!--" alt="photo-user">-->
            <!--                    </div>-->
            <!--                    <p>Мои посты</p>-->
            <!--                </button>-->
            <!--            </div>-->

            <!-- Если авторизованый пользователь -->
            <?php if (Yii::$app->user->isGuest):?>

                <!-- Если авторизованый пользователь -->
            <?php else: ?>

                <div class="my-new-post">
                    <button class="btn-my-new-post"  onclick="window.location.href ='<?= Url::toRoute(['/reviewscarpost/myreviewscarpost', 'id' => Yii::$app->user->id]) ?>'">
                        <div class="img-user-new">
                            <img src="<?= $users->getImageUser()?>" alt="photo-user">
                        </div>
                        <p>Мои посты</p>
                    </button>
                </div>
            <?php endif;?>

        </div>
    </div>


    <div class="block-center-new">

        <!-- Если в таблице БД "Новости" пусто -->
        <?php if (empty($reviewscars)): ?>

            <div class="block-null-new-post">
                <p>Пусто...</p>
            </div>

            <!-- Если есть посты -->
        <?php else: ?>

            <?php foreach ($reviewscars as $reviewscar):?>

                <div class="info-only-new-post">

                    <div class="img-user-name-title-data-category-new-post">
                        <div class="img-user-name-title-category-new-post">
                            <div class="img-user-create-new-post">
                                <!-- Аватарка пользователя -->
                                <img src="<?= User::findOne($reviewscar -> id_user) -> getImageUser() ?>" alt="img-user">
                            </div>
                            <div class="name-title-category-new-post">
                                <!-- ФИО пользователя -->
                                <p><?= User::findOne($reviewscar -> id_user) -> fio ?></p>
                                <!-- Категория Новости-поста -->
                                <a style="text-decoration: underline"><?= CategoryReviews::findOne($reviewscar->id_category_reviews) -> name_category_reviews ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="description-post-new">
                        <p></p>
                    </div>
                    <div class="photo-new-post">
                        <!-- Фото Новости-поста -->
                        <img src="<?= $reviewscar -> getImagePostReviews() ?>" alt="photo-new-post">
                    </div>

                    <div class="title-text-content-new-post">
                        <div class="title-new-post">
                            <!-- Название Новости-поста -->
                            <h1><?= $reviewscar -> title ?></h1>
                        </div>
                        <div class="content-new-post">
                            <!-- Контент Новости-поста -->
                            <p><?= $reviewscar -> content_reviews ?></p>
                        </div>
                    </div>
                    <div class="like-views-data-post-new">
                        <div class="like-views-new-post">
                            <i class="fa-solid fa-heart"></i>

                            <!-- Количество лайков -->
                            <p id="likeCount" class="quantity-like"><?= $reviewscar -> getLikesCount() ?></p>

                            <!-- Количество просмотров -->
                            <p class="views-new-post"><i class="fa-solid fa-eye"></i> <?= $reviewscar -> viewed_reviews ?></p>
                        </div>

                        <!-- Дата публикации Новости-пост -->
                        <div class="data-create-new-post">
                            <p><?= Yii::$app->formatter->asDate($reviewscar->date_register_reviews, 'php:d.m.Y') ?></p>
                        </div>
                    </div>
                    <div class="like-container like-comments-btn-post-new">

                        <!-- Если пользователь не лайкнул (Основной текст и цвет)-->
                        <?php if (!$reviewscar->userHasLikedPost(Yii::$app->user->id)): ?>
                            <a class="like-icon like-new-post" id="likeIcon" href="<?= Url::toRoute(['/reviewscarpost/like', 'postId' => $reviewscar->id]) ?>">
                                <i class="fa-solid fa-heart"></i>
                                <p>Нравится</p>
                            </a>

                            <!-- Если пользователь лайкнул (Меняется текст и цвет) -->
                        <?php else: ?>
                            <a class="like-icon like-new-post liked" id="likeIcon" href="<?= Url::toRoute(['/reviewscarpost/unlike', 'postId' => $reviewscar->id]) ?>">
                                <i class="fa-solid fa-heart"></i>
                                <p>Не нравится</p>
                            </a>
                        <?php endif; ?>


                        <a href="<?= Url::toRoute(['/reviewscarpost/post', 'id' => $reviewscar -> id]) ?>" class="comments-new-post" >
                            <i class="fa-solid fa-comment"></i>
                            <p>Комментарии</p>
                        </a>

                        <a href="<?= Url::toRoute(['/site/deletereviewscarpost', 'id' => $reviewscar -> id],['data' => ['method' => 'post',],]) ?>" class="delete-new-post" >
                            <i class="fa-solid fa-trash"></i>
                            <p>Удалить</p>
                        </a>

                    </div>
                </div>

            <?php endforeach;?>

            <!-- Пагинация -->
            <?= LinkPager::widget(['pagination' => $pagination]) ?>

        <?php endif; ?>




    </div>

    <!-- Рекламный баннер -->
    <div class="block-right-new">
        <div class="advertisement-post">
            <a href="#"><img src="/all_img/logo_order/advertisement.png" alt=""></a>

        </div>
    </div>

</div>


