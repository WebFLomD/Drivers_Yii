<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'О проекте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="o-nas-index">
    <p class="o-nas-title"><?= $this->title ?></p>
    <div class="o-nas-inform">
        <p> Drivers.ru — один из самых посещаемых автомобильных сайтов в российском интернете</p>
        <p> Мы предлагаем большой выбор легковых автомобилей, грузового и коммерческого транспорта, мототехники, спецтехники и многих других видов транспортных средств</p>
    </div>

    <p class="o-nas-map">Карта</p>
    <div id="map-o-nas">
        <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1946.6440217870056!2d36.3121366040195!3d54.53414912716706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4134b912aeada8ef%3A0xef64b95e05de56e4!2z0JrQsNC70YPQttGB0LrQuNC5INGC0LXRhdC90LjRh9C10YHQutC40Lkg0LrQvtC70LvQtdC00LY!5e0!3m2!1sru!2sru!4v1705677346993!5m2!1sru!2sru" ></iframe>
    </div>

</div>
