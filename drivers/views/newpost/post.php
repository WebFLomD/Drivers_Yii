<?php

use app\models\Category;
use app\models\Newpost;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\search\NewpostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block-new">
    <div class="block-left-new-btn">
        <div class="block-left-new">
            <div class="title-new">
                <p>Новости</p>
            </div>
            <div class="btn-create-new-post">
                <button onclick="window.location.href = '<?= Url::toRoute(['/newpost/create'])?>';"><i class="fa-solid fa-pen-to-square"></i> Создать Запись</button>
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
                <button class="btn-my-new-post" onclick="window.location.href ='<?= Url::toRoute(['/newpost/mynewpost', 'id' => Yii::$app->user->id]) ?>'">
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

            <div class="info-only-new-post">

                <div class="img-user-name-title-data-category-new-post">
                    <div class="img-user-name-title-category-new-post">
                        <div class="img-user-create-new-post">
                            <!-- Аватарка пользователя -->
                            <img src="<?= User::findOne($news -> id_user) -> getImageUser() ?>" alt="img-user">
                        </div>
                        <div class="name-title-category-new-post">
                            <!-- ФИО пользователя -->
                            <p><?= User::findOne($news -> id_user) -> fio ?></p>
                            <!-- Категория Новости-поста -->
                            <a style="text-decoration: underline"><?= Category::findOne($news->id_category) -> name_category ?></a>
                        </div>
                    </div>
                </div>

                <div class="description-post-new">
                    <p></p>
                </div>
                <div class="photo-new-post">
                    <!-- Фото Новости-поста -->
                    <img src="<?= $news -> getImagePostNew() ?>" alt="photo-new-post">
                </div>

                <div class="title-text-content-new-post">
                    <div class="title-new-post">
                        <!-- Название Новости-поста -->
                        <h1><?= $news -> title_new ?></h1>
                    </div>
                    <div class="content-new-post">
                        <!-- Контент Новости-поста -->
                        <p><?= $news -> content_new ?></p>
                        <p><?= nl2br(htmlentities($news -> description_new)) ?></p>
                    </div>
                </div>
                <div class="like-views-data-post-new">
                    <div class="like-views-new-post">
                        <i class="fa-solid fa-heart"></i>

                        <!-- Количество лайков -->
                        <p id="likeCount" class="quantity-like"><?= $news -> getLikesCount() ?></p>

                        <!-- Количество просмотров -->
                        <p class="views-new-post"><i class="fa-solid fa-eye"></i> <?= $news -> viewed_new_post ?></p>
                    </div>

                    <!-- Дата публикации Новости-пост -->
                    <div class="data-create-new-post">
                        <p><?= Yii::$app->formatter->asDate($news->date_register_new_post, 'php:d.m.Y') ?></p>
                    </div>
                </div>
                <div class="like-container like-comments-btn-post-new">

                    <!-- Если пользователь не лайкнул (Основной текст и цвет)-->
                    <?php if (!$news->userHasLikedPost(Yii::$app->user->id)): ?>
                        <a class="like-icon like-new-post" id="likeIcon" href="<?= Url::toRoute(['/newpost/like', 'postId' => $news->id]) ?>">
                            <i class="fa-solid fa-heart"></i>
                            <p>Нравится</p>
                        </a>

                        <!-- Если пользователь лайкнул (Меняется текст и цвет) -->
                    <?php else: ?>
                        <a class="like-icon like-new-post liked" id="likeIcon" href="<?= Url::toRoute(['/newpost/unlike', 'postId' => $news->id]) ?>">
                            <i class="fa-solid fa-heart"></i>
                            <p>Не нравится</p>
                        </a>
                    <?php endif; ?>


                </div>
            </div>

        <h1>Комметарии</h1>



        <?php if (empty($commentsP)):?>

        <div class="block-null-new-post">
            <p>Пусто...</p>
        </div>

        <?php else:?>

            <?php foreach ($commentsP as $comment):?>

                <div class="info-only-new-post all-comments-new-post">



                    <div class="img-name-date-comments">
                        <div class="img-name-user-comments">
                            <div class="img-user-new-comments">
                                <img src="<?= User::findOne($comment->id_user) ->getImageUser() ?>" alt="user">
                            </div>

                            <p><?= User::findOne($comment -> id_user) -> username ?></p>
                        </div>
                        <p class="data-register-comments"><?= Yii::$app->formatter->asDate($comment -> data_comment, 'php:d.m.Y H:i') ?></p>
                    </div>

                    <div class="comments-text">
                        <p><?= $comment -> text_new ?></p>
                    </div>

                </div>

            <?php endforeach; ?>

            <!-- Пагинация -->
            <?= LinkPager::widget(['pagination' => $pagination]) ?>

        <?php endif;?>

        <?php if (Yii::$app->user->isGuest): ?>

        <?php else: ?>

        <?php $form = ActiveForm::begin([
                'action' => ['site/comment', 'id' => $news->id],
                'options' => ['class' => 'info-only-new-post input-comments-post-new', 'role' => 'form']
            ]) ?>

                <?= $form->field($commentForm, 'comment') -> textarea(['class' => 'input-comments', 'placeholder' => 'Написать комментарии...']) -> label(false) ?>
                <button type="submit" title="Отправить"><i class="fa-solid fa-share"></i><i class="fa-solid fa-paper-plane-top"></i></button>

        <?php ActiveForm::end(); ?>

<!--            <div class="info-only-new-post input-comments-post-new">-->
<!--                <input class="input-comments" type="text" placeholder="Написать комментарии...">-->
<!--                <a href="--><?php //= Url::to(['site/add-comment']); ?><!--" title="Отправить"><i class="fa-solid fa-paper-plane-top"></i></a>-->
<!--            </div>-->
        <?php endif; ?>

    </div>


    <!-- Рекламный баннер -->
    <div class="block-right-new">
        <div class="advertisement-post">
            <a href="#"><img src="/all_img/logo_order/advertisement.png" alt=""></a>

        </div>
    </div>

</div>



