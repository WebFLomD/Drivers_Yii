<?php

$this->title = 'Управление объявлениями';
?>

<div class="post-admin">
    <h1><?= $this->title ?></h1>
    <div class="btn-post-admin">
        <button class="status-btn-post-admin" onclick="showContent('content1')">Новые</button>
        <button class="status-btn-post-admin" onclick="showContent('content2')">Принятые</button>
        <button class="status-btn-post-admin" onclick="showContent('content3')">Отклоненые</button>
    </div>

    <div class="post-index-admin post-all-cars content" id = "content1">

        <div class="post-all-cars">

            <?php use yii\helpers\Url;

            foreach ($cars as $car): ?>
                <div class="post-only-cars">
                    <div class="photo-cars">
                        <img src="<?= $car -> getImage_1();?>" alt="post-only-cars">
                    </div>
                    <div class="info-car-post">
                        <div class="price-car-post-index">
                            <p class="kakoytoclass"><?= $car -> price ?> рублей</p>
                        </div>
                        <div class="title-car-index">
                            <p><?= $car -> name_car?></p>
                        </div>
                        <div class="additionally">
                            <p>2024 /</p>
                            <p class="kakoytoclass" id="probeg-text"><?= $car -> mileage?> км</p>
                        </div>
                    </div>
                    <div class="btn-post-car">
                        <a href="<?= Url::toRoute(['/car/post', 'id' => $car-> id]) ?>">Посмотреть пост</a>
                    </div>
                    <div class="btn-post-car-try" style="margin-top: 10px">
                        <a href="<?= Url::toRoute(['accept', 'id' => $car->id]) ?>">Принять</a>
                    </div>
                    <div class="btn-post-car-false" style="margin-top: 10px">
                        <a href="<?= Url::toRoute(['reject', 'id' => $car->id]) ?>">Отклонить</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

    <div class="post-index-admin post-all-cars content" id = "content2">

        <div class="post-all-cars">


            <?php foreach ($cars_try as $car): ?>
                <div class="post-only-cars">
                    <div class="photo-cars">
                        <img src="<?= $car -> getImage_1();?>" alt="post-only-cars">
                    </div>
                    <div class="info-car-post">
                        <div class="price-car-post-index">
                            <p class="kakoytoclass"><?= $car -> price ?> рублей</p>
                        </div>
                        <div class="title-car-index">
                            <p><?= $car -> name_car?></p>
                        </div>
                        <div class="additionally">
                            <p>2024 /</p>
                            <p class="kakoytoclass" id="probeg-text"><?= $car -> mileage?> км</p>
                        </div>
                    </div>
                    <div class="btn-post-car">
                        <a href="<?= Url::toRoute(['/car/post', 'id' => $car-> id]) ?>">Подробнее</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

    <div class="post-index-admin post-all-cars content" id = "content3">

        <div class="post-all-cars">


            <?php foreach ($cars_false as $car): ?>
                <div class="post-only-cars">
                    <div class="photo-cars">
                        <img src="<?= $car -> getImage_1();?>" alt="post-only-cars">
                    </div>
                    <div class="info-car-post">
                        <div class="price-car-post-index">
                            <p class="kakoytoclass"><?= $car -> price ?> рублей</p>
                        </div>
                        <div class="title-car-index">
                            <p><?= $car -> name_car?></p>
                        </div>
                        <div class="additionally">
                            <p>2024 /</p>
                            <p class="kakoytoclass" id="probeg-text"><?= $car -> mileage?> км</p>
                        </div>
                    </div>
                    <div class="btn-post-car">
                        <a href="<?= Url::toRoute(['/car/post', 'id' => $car-> id]) ?>">Подробнее</a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

</div>

<script>
    function showContent(contentId) {
        // Hide all content
        var contents = document.querySelectorAll('.content');
        contents.forEach(function(content) {
            content.classList.remove('active');
        });

        // Show the selected content
        document.getElementById(contentId).classList.add('active');
    }

    // Show the first content by default
    showContent('content1');
</script>
