<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\assets\PublicAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

PublicAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="navigator">
    <div class="logo-navigator">
        <a href="<?= Url::toRoute('/site/index') ?>"><img src="/all_img/logo_order/logo-dark.png" alt="logo"></a>
    </div>
    <nav>
        <ul class="nav-links-text">
            <li>
                <a href="<?= Url::toRoute('/site/index') ?>">Техника</a>
                <ul id="panel-nav">
                    <li ><a href="<?= Url::toRoute(['/site/technic', 'id' => 1, 'status' => 2]);?>">Автомобили</a></li>
                    <li><a href="<?= Url::toRoute(['/site/technic', 'id' => 2, 'status' => 2]);?>">Мототехника</a></li>
                    <li><a href="<?= Url::toRoute(['/site/technic', 'id' => 3, 'status' => 2]);?>">Спецтехника</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= Url::toRoute(['/autoparts']) ?>">АвтоЗапчасти</a>
                <ul>
                    <li><a href="<?= Url::toRoute(['/autoparts/create']) ?>">Продать АвтоЗапчасти</a></li>
                    <li><a href="<?= Url::toRoute(['/autoparts/search']) ?>">Поиск</a></li>
                </ul>
            </li>
            <li><a href="<?= Url::toRoute(['/newpost']);?>">Новости</a></li>
            <li><a href="<?= Url::toRoute(['/site/help']) ?>">Помощь</a></li>
            <li>
                <a style="cursor: pointer;">Еще <i class="fa-solid fa-chevron-down"></i></a>
                <ul>
                    <li><a href="<?= Url::toRoute(['/site/purchase_and_sale_agreement']);?>">Договор купли-продажи</a></li>
                    <li><a href="<?= Url::toRoute(['/reviewscarpost']) ?>">Отзывы владельцов</a></li>
                    <li><a href="<?= Url::toRoute(['/site/about']) ?>">О проекте</a></li>
<!--                    <li><a href="#">Техподдержка</a></li>-->
                    <li><a href="<?= Url::toRoute(['/site/agreement']) ?>">Пользовательское соглашение</a></li>
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()):?>
                        <li><a href="<?= Url::toRoute(['/admin']) ?>">Панель администратора</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="btn-submit-an-ad"><a href="<?= Url::toRoute('/car/create') ?>">Подать объявление</a></li>

            <!-- Если Гость -->
            <?php if (Yii::$app->user->isGuest):?>

            <li class="btn-login"><a href="<?= Url::toRoute('/site/login') ?>">Войти</a></li>

            <!-- Если авторизованый пользователь -->
            <?php else: ?>

                <li class="btn-login">
                    <a href="<?= Url::toRoute(['/user/profile', 'id' => Yii::$app->user->id])?>">
                        Личный кабинет
                    </a>
                </li>

            <?php endif;?>

        </ul>
    </nav>
</header>

<?= $content ?>
<?php
$currentRoute = Yii::$app->controller->getRoute();

$noFooterRoutes = [
    'site/login',
    'user/create',
    'admin/index',
    'admin/index-user',
    'admin/index-post-admin',
    'admin/index-brand-car',
    'admin/index-user-cite',
    'brandcar/create',
    'brandcar/update',
    'user-cite/create',
    'user-cite/update',
    'site/error',
    // Добавьте другие маршруты, если необходимо
];

if(!in_array($currentRoute, $noFooterRoutes)):
?>
    <footer class="footer">
    <div class="footer-all">
        <div class="footer-block-left">
            <div class="logo-footer">
                <a href="/site/index"><img src="/all_img/logo_order/logo-white.png" alt="logo"></a>
            </div>
            <div class="about-cooperation">
                <p>Drivers.ru — один из самых посещаемых автомобильных сайтов в российском интернете.</p>
            </div>
            <div class="follow-us">
                <p class="footer-block-all-title">Следуйте за нами</p>
                <div class="logo-site">
                    <a href="https://vk.com/ktk40_professionalitet" target="_blank" class="icon-logo-site-vk"><img src="/all_img/logo_order/VK.png" id="icon-site-vk" alt="VK"></a>
                    <a href="https://t.me/ktk40_professionalitet" target="_blank" class="icon-logo-site-tg"><img src="/all_img/logo_order/TG.png" id="icon-site-tg" alt="TG"></a>
                    <a href="https://ok.ru/ktk40" target="_blank" class="icon-logo-site-ok"><img src="/all_img/logo_order/OK.png" id="icon-site-ok" alt="OK"></a>
                </div>
            </div>
        </div>
        <div class="footer-block-center-right">
            <p class="footer-block-all-title">Навигатор</p>
            <div class="footer-navigator-flex">
                <ul>
                    <li><a href="<?= Url::toRoute(['/site/technic', 'id' => 1, 'status' => 2]);?>">Автомобили</a></li>
                    <li><a href="<?= Url::toRoute(['/site/technic', 'id' => 2, 'status' => 2]);?>">Мототехника</a></li>
                    <li><a href="<?= Url::toRoute(['/site/technic', 'id' => 3, 'status' => 2]);?>">Спецтехника</a></li>
                    <li><a href="<?= Url::toRoute(['/autoparts']);?>">АвтоЗапчасти</a></li>
                    <li><a href="<?= Url::toRoute(['/user/profile', 'id' => Yii::$app->user->id]);?>">Профиль</a></li>
                </ul>
                <ul>
                    <li><a href="<?= Url::toRoute(['/newpost']);?>">Новости и статьи</a></li>
                    <li><a href="<?= Url::toRoute(['/car/create']);?>">Подать объявление</a></li>
                    <li><a href="<?= Url::toRoute(['/site/purchase_and_sale_agreement']);?>">Договор купли-продажи</a></li>
                    <li><a href="<?= Url::toRoute(['/reviewscarpost']) ?>">Отзывы владельцов</a></li>
                    <li><a href="<?= Url::toRoute(['/site/about']) ?>">О проекте</a></li>

                </ul>
            </div>


        </div>
        <div class="footer-block-center-right">
            <p class="footer-block-all-title">Служба поддержки</p>
            <ul>
                <li><a href="<?= Url::toRoute(['/site/agreement']) ?>">Пользовательское соглашение</a></li>
<!--                <li><a href="">Безопосность</a></li>-->
<!--                <li><a href="">Техподдержка</a></li>-->
                <li><a href="<?= Url::toRoute(['/site/help']) ?>">Помощь</a></li>
            </ul>
        </div>
    </div>
    <div class="block-rights-reserved">
        <p>© 2024 Все права защищены. <br>
            Разработал Захаров Александр Дмиртриевич</p>
    </div>
</footer>
<?php endif;
?>

<?php if(class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
$this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
