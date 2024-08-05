<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/form-auth-register.css', #Регистрация и авторизация
        'public/css/error.css', # Ошибка/сообщение (меняет обычного на нужный цвет текста в авторизации и регистрации)
        'public/css/fon.css', # Фон (для всей страницы)
        'public/css/nav-footer.css', # Навигатор и подвал
        'public/css/index.css', # Главная страница
        'public/css/car-create.css', # Размещение авто на продажу
        'public/css/car-post.css', # Пост авто
        'public/css/pagination.css', # Пагинация (Дизайн)
        'public/css/profile.css', # Профиль
        'public/css/new.css', # Новости
        'public/css/create-new-post.css', # Создание пост Новости
        'public/css/auto-parts.css', # АвтоЗапчасти
        'public/css/auto-parts-post.css', # Пост АвтоЗапчасти
        'public/css/update-user.css',
        'public/css/about.css',
        'public/css/help.css',
        'public/css/purchase-and-sale-agreement.css',
        'public/css/table-admin.css',
        'public/css/admin-index.css',
        'public/css/fontawesome-free-6.5.2-web/css/all.min.css',
        # 'https://cdn.jsdelivr.net/gh/eliyantosarage/font-awesome-pro@main/fontawesome-pro-6.5.2-web/css/all.min.css', # Профильная(Платная) Font Awesome (для иконки)

    ];
    public $js = [
        'public/js/password.js', # Скрывает и показывает пароль
        'public/js/the-gap-between-thousands.js', # Автопробел больших чисел (1 000, 100 000)
        'public/js/slider.js', # Слайдер
        'public/js/loadImage.js',
        'public/js/help.js',
        'public/js/answer.js',
        'public/js/loadFile.js',
    ];
    public $depends = [
    ];
}
