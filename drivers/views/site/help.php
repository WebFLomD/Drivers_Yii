<?php

use yii\helpers\Url;

$this -> title = "Помощь";
?>

<div class="block-help">

    <div class="block-help-lvl">
        <div class="title-btn-help">
            <div class="title-help">
                <p>Почему в моём объявлении другой номер телефона?</p>
            </div>
            <div class="btn-help">
                <a class="btn"  id="show-hide-btn">Показать</a>
            </div>
        </div>

        <div class="text-help hidden">
            <p class="info-text-help"> Скорее всего, в вашем объявлении подключен Подменный номер. Не волнуйтесь, звонки от покупателей переадресовываются на номер, который вы указали в объявлении. Подменный номер защищает вас от смс и спам-звонков и позволяет собирать в личном кабинете статистику звонков. Это бесплатная опция, доступная по умолчанию всем объявлениям. Мы не рекомендуем её отключать.</p>
        </div>

    </div>

    <div class="block-help-lvl">
        <div class="title-btn-help">
            <div class="title-help">
                <p>Регистрация</p>
            </div>
            <div class="btn-help">
                <a class="btn"  id="show-hide-btn">Показать</a>
            </div>
        </div>

        <div class="text-help hidden">
            <p class="info-text-help"> После регистрации на Drivers.ru вы сможете размещать и редактировать объявления, сохранять поиски и избранные объявления.<br>
                При регистрации создается личный кабинет, в котором хранится информация обо всех объявлениях, а также ваши контакты.</p>
            <p class="info-text-help">Если выдает сообщение о том, что аккаунт зарегистрирован, попробуйте <a href="<?= Url::toRoute(['/site/login']) ?>">войти</a>.</p>
        </div>

    </div>

    <div class="block-help-lvl">
        <div class="title-btn-help">
            <div class="title-help">
                <p>Авторизация</p>
            </div>
            <div class="btn-help">
                <a class="btn"  id="show-hide-btn">Показать</a>
            </div>
        </div>

        <div class="text-help hidden">
            <p class="info-text-help">1. Не могу войти</p>
            <p class="info-text-help">Причин может быть несколько:</p>
            <ul class="info-text-help">
                <li>Проверьте правильно ли вы ввели логин или пароль.</li>
                <li>Аккаунт не зарегистрирован, вы можете зарегистрироваться перейдите <a href="<?= Url::toRoute(['/user/create']) ?>">регистрация</a>.</li>
                <li>Аккаун удален.</li>
            </ul>
        </div>

    </div>

    <div class="block-help-lvl">
        <div class="title-btn-help">
            <div class="title-help">
                <p>Вопрос по рекламе на сайте</p>
            </div>
            <div class="btn-help">
                <a class="btn"  id="show-hide-btn">Показать</a>
            </div>
        </div>

        <div class="text-help hidden">
            <p class="info-text-help"> По вопросам размещения текстовой и баннерной рекламы, пожалуйста, обращайтесь по e-mail drivers@mail.ru <br>
                Если вы представляете рекламное агентство, пишите на drivers@mail.ru</p>
        </div>

    </div>

    <!--
            <div class="block-help-lvl">
                <div class="title-btn-help">
                    <div class="title-help">
                        <p>Название</p>
                    </div>
                    <div class="btn-help">
                        <a class="btn"  id="show-hide-btn2">Показать</a>
                    </div>
                </div>

                <div class="text-help2 hidden">
                    <p class="info-text-help"> Внезапно, диаграммы связей представляют собой не что иное, как квинтэссенцию победы маркетинга над разумом и должны быть разоблачены. Не следует, однако, забывать, что понимание сути ресурсосберегающих технологий является качественно новой ступенью направлений прогрессивного развития. А ещё интерактивные прототипы освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, превращены в посмешище, хотя само их существование приносит несомненную пользу обществу. Для современного мира постоянное информационно-пропагандистское обеспечение нашей деятельности не оставляет шанса для соответствующих условий активизации.</p>
                </div>

            </div> -->

</div>