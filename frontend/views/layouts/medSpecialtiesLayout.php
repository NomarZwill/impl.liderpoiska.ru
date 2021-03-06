<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header_wrapper">

    <div class="header_top_wrapper">

        <a href="/">

            <div class="logo_wrapper">

                <div class="logo_img"></div>
                <div class="logo_name">
                    <p>Центр Эстетической Стоматологии</p>
                </div>

            </div>

        </a>
    
        <div class="clinics_on_the_map">
            <a class="_menu_link_dashed" href="/contacts/">Филиалы на карте</a>
            <div class="clinics_mob_icon"></div>
        </div>
    
        <div class="contacts_container">
    
            <div class="phones">
                <p>+7 (495) 150-27-16</p>
                <p>+7 (495) 930-22-56</p>
            </div>
    
            <div class="work_hours">
                <p>Будни: 9:00—20:30, Сб: 9:00—18:00, Вс: 10:00—17:00</p>
            </div>

            <div class="contacts_mob_icon"></div>
    
        </div>
    
        <div class="popup_button_wrapper">
            <button class="_button popup_button">Заказать звонок</button>
        </div>

        <div class="burger_wrapper">
            <div class="burger_img"></div>
        </div>

    </div>

    <hr class="header_line">

    <div class="header_navbar_wrapper">

        <div class="navbar_item"><a class="_menu_link_no_borders" href="/dent/">Услуги</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/about/">О компании</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/specialists/">Стоматологи</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/contacts/">Клиники</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/price/">Цены</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/partners/">Партнёры</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/contacts/">Контакты</a></div>

    </div>

</header>
    
<div class="container">
    <?= $content ?>
</div>

<footer class="footer_wrapper">

    <div class="footer_middle_wrapper">

        <div class="to_patients">

            <div class="title">
                <p>Пациентам</p>
            </div>

            <div class="to_patients_item"><a class="_menu_link" href="/about/">О компании</a></div>
            <div class="to_patients_item"><a class="_menu_link" href="/contacts/">Клиники</a></div>
            <div class="to_patients_item"><a class="_menu_link" href="/specialists/">Стоматологи</a></div>
            <div class="to_patients_item"><a class="_menu_link" href="/partners/">Партнёры</a></div>
            <div class="to_patients_item"><a class="_menu_link" href="/price/">Цены</a></div>
            <div class="to_patients_item"><a class="_menu_link" href="/contacts/">Контакты</a></div>
            <div class="to_patients_item"><a class="_menu_link" href="/">Гарантии</a></div>
            <div class="to_patients_item"><a class="_menu_link" href="/">Лечение по ДМС</a></div>
        </div>

        <div class="servises_wrapper">

            <div class="title">
                <p>Услуги</p>
            </div>

            <div class="servises">
                
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Терапия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Ортопедия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Хирургия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Имплантация зубов</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Ортодонтия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Эстетическая реставрация <br> зубов</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Отбеливание зубов</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Пародонтология</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Эндодонтия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Профессиональная гигиена <br> полости рта</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Анестезиология</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/contacts/"><span>Диагностика</span></a></div>

            </div>


        </div>

        <div class="contacts_wrapper">

            <a class="_menu_link_no_borders" href="/">
                <div class="logo_wrapper">

                    <div class="logo_img"></div>
                    <div class="logo_name">
                        <p>Центр Эстетической Стоматологии<br>© 2002 — 2020</p>
                    </div>

                </div>
            </a>

            <div class="phones">
                <p>+7 (495) 150-27-16</p>
                <p>+7 (495) 930-22-56</p>
            </div>
    
            <div class="work_hours">
                <p>Будни: 9:00—20:30,<br class="work_hours_text_pad"> Сб: 9:00—18:00, Вс: 10:00—17:00</p>
            </div>

            <div class="instagram">
                <a class="_menu_link" href="https://www.instagram.com/impl.ru/" target="_blank">Наш инстаграм</a>
            </div>

        </div>

    </div>

    <div class="footer_bottom_wrapper">

        <a class="_menu_link" href="/agreement/">Политика&nbsp;конфиденциальности</a>

        <p>Информация, представленная на сайте, не может быть использована для постановки диагноза, назначения лечения и не заменяет прием врача.</p>

        <a class="_menu_link_no_borders lp_label" href="http://liderpoiska.ru/" target="_blank">Создание&nbsp;и&nbsp;продвижение&nbsp;сайта<br>«Лидер поиска»</a>
    </div>
    
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
