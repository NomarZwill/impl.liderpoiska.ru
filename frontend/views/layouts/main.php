<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use backend\models\Servises;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="icon" type="image/png" href="/img/favicon.ico" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->title ?></title>
    <?php if (!empty($this->params['desc'])) echo "<meta name='description' content='" . $this->params['desc'] . "'>";?>
    <?php if (!empty($this->params['kw'])) echo "<meta name='keywords' content='" . $this->params['kw'] . "'>";?>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <noscript><img height="1" width="1" style="display:none" alt="" src="https://www.facebook.com/tr?id=693345340845343&ev=PageView&noscript=1"/></noscript>

</head>
<body>
<?php $this->beginBody() ?>

<header class="header_wrapper">

    <div class="header_top_wrapper">

        <a href="/">

            <div class="logo_wrapper">

                <div class="logo_img"></div>
                <div class="logo_name">
                    <p>Центр Стоматологической Имплантологии</p>
                </div>

            </div>

        </a>
    
        <div class="clinics_on_the_map">

            <a class="_menu_link_dashed" href="/contacts/">Филиалы на карте</a>

            <a href="/contacts/">
                <img class="clinics_mob_icon" src="/img/location-pin-mobile.svg" alt="">
            </a>

        </div>
    
        <div class="contacts_container">
    
            <div class="phones">
                <a href="tel:4951502716">+7 (495) 150-27-16</a>
                <a href="tel:4959302256">+7 (495) 930-22-56</a>
            </div>
    
            <div class="work_hours">
                <p>Будни: 9:00—20:30, Сб: 9:00—18:00, Вс: 10:00—17:00</p>
            </div>

            <div class="contacts_mob_icon"></div>
    
        </div>
    
        <div class="popup_button_wrapper recall_form_popup">

            <button class="_button popup_button">Заказать звонок</button>

            <div class="recall_form_container _hidden">

                <div class="recall_form_wrapper" data-page-type="recall_form">

                    <?= $this->render('../components/recall_form.twig', 
                    [
                        'title' => '<h3>Заказать звонок</h3>',
                        'title_description' => 'Оставьте ваши данные, и мы перезвоним в течение 15 минут.',
                        'submit_button_title' => 'Отправить',
                        'csrf' => Yii::$app->request->getCsrfToken(),
                        'in_content_block' => ''
                    ]) ?>

                </div>

            </div>

        </div>

        <div class="burger_wrapper">
            <div class="burger_img">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

    </div>

    <hr class="header_line">

    <div class="header_navbar_wrapper">

        <div class="navbar_item service_dropdown_menu_container">

            <a class="_menu_link_no_borders" href="" onclick="return false">Услуги</a>

            <div class="service_dropdown_menu_wrapper">
                <?php
                    $servises_model = Servises::find()
                      ->select(['parent_id', 'servise_id', 'alias', 'servise_listing_sort', 'header_menu_title'])
                      ->where(['is_active' => 1, 'is_visible_in_menu' => 1])
                      ->groupBy(['parent_id', 'servise_listing_sort', 'servise_id', 'alias', 'header_menu_title'])
                      ->asArray()
                      ->all();

                    $servises = array();

                    foreach ($servises_model as $key => $item) {
                       $servises[$item['parent_id']][$item['servise_id']] = $item;
                    }


                    echo $this->render('../components/header_dropdown_menu_fast.twig', ['servises' => $servises]);

                ?>

                <div class="service_dropdown_menu_shadow"></div>

            </div>

        </div>

        <div class="navbar_item about_dropdown_container">
            <a class="_menu_link_no_borders _mobile" href="" onclick="return false">О компании</a>
            <a class="_menu_link_no_borders" href="/about/">О компании</a>

            <div class="about_dropdown_menu_background _hidden">

                <div class="about_dropdown_menu_wrapper">

                    <div class="about_back_button_wrapper">
                        <button>Назад</button>
                    </div>

                    <div class="about_dropdown_menu_item">
                        <a class="_menu_link_no_borders" href="/about/">О компании</a>
                    </div>

                    <div class="about_dropdown_menu_item">
                        <a class="_menu_link_no_borders" href="/reviews/">Отзывы</a>
                    </div>

                    <div class="about_dropdown_menu_item">
                        <a class="_menu_link_no_borders" href="/faq/">Вопрос-ответ</a>
                    </div>
                    <div class="about_dropdown_menu_item">
                        <a class="_menu_link_no_borders" href="/garantii-na-stomatologicheskie-uslugi/">Гарантии</a>
                    </div>
                    <div class="about_dropdown_menu_item">
                        <a class="_menu_link_no_borders" href="/lizcenz/">Лицензии</a>
                    </div>

                </div>

                <div class="service_dropdown_menu_shadow"></div>

            </div>

        </div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/specialists/">Стоматологи</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/price/">Цены</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/partners/">Партнёры</a></div>
        <div class="navbar_item"><a class="_menu_link_no_borders" href="/contacts/">Контакты клиник</a></div>
        
        <div class="mobile_mini_footer">

            <div class="phones">
                <a href="tel:4959302256">+7 (495) 930-22-56</a>
                <a href="tel:4951502716">+7 (495) 150-27-16</a>
            </div>

            <div class="work_hours">
                <p>Будни: 9:00—20:30,<br> Сб: 9:00—18:00, Вс: 10:00—17:00</p>
            </div>

            <div class="instagram">
                <a class="_menu_link" href="https://www.instagram.com/impl.ru/" target="_blank">Наш инстаграм</a>
            </div>

        </div>

    </div>

</header>
    
<div class="container">
    <?= $content ?>
</div>

<footer class="footer_wrapper">

    <div class="footer_top_wrapper">

        <div class="footer_top">

            <div class="feedback_img"></div>

            <div class="footer_top_text">
            
                <h4>Запишитесь на консультацию</h4>

                <p>С радостью ответим на ваши вопросы и запишем к&nbsp;нужному&nbsp;специалисту.</p>
            
            </div>

            <div class="contacts_wrapper">

                <div class="phones">
                    <a href="tel:4959302256">+7 (495) 930-22-56</a>
                    <a href="tel:4951502716">+7 (495) 150-27-16</a>
                </div>
        
                <div class="work_hours">
                    <p>Будни: 9:00—20:30, Сб: 9:00—18:00, Вс: 10:00—17:00</p>
                </div>

            </div>

            <div class="popup_button_wrapper">
                <button class="reception_button _button popup_button">Записаться&nbsp;на&nbsp;прием</button>
            </div>

        </div>
    </div>

    <div class="footer_middle_wrapper">

        <div class="to_patients">

            <div class="title">
                <p>Пациентам</p>
            </div>

            <div class="first_column">

                <div class="to_patients_item"><a class="_menu_link" href="/about/">О компании</a></div>
                <!-- <div class="to_patients_item"><a class="_menu_link" href="/contacts/">Клиники</a></div> -->
                <div class="to_patients_item"><a class="_menu_link" href="/specialists/">Стоматологи</a></div>
                <div class="to_patients_item"><a class="_menu_link" href="/partners/">Партнёры</a></div>
                <div class="to_patients_item"><a class="_menu_link" href="/price/">Цены</a></div>
                <div class="to_patients_item"><a class="_menu_link" href="/reviews/">Отзывы</a></div>
                <div class="to_patients_item"><a class="_menu_link" href="/garantii-na-stomatologicheskie-uslugi/">Гарантии</a></div>
                <div class="to_patients_item"><a class="_menu_link" href="/lizcenz/">Лицензии</a></div>
                <div class="to_patients_item"><a class="_menu_link" href="/contacts/">Контакты</a></div>

            </div>

            <div class="second_column">

                <div class="to_patients_item"><a class="_menu_link" href="/faq/">Вопросы и ответы</a></div>
                <div class="to_patients_item"><a class="_menu_link" href="/specialnoe/">Спецпредложения</a></div>

            </div>
        </div>

        <div class="servises_wrapper">

            <div class="title">
                <p>Услуги</p>
            </div>

            <div class="servises">
                
                <div class="servises_item"><a class="_menu_link" href="/dent/terapiya/"><span>Терапия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/ortoped/"><span>Ортопедия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/hirurg/"><span>Хирургия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/impl/"><span>Имплантация зубов</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/ortodont/"><span>Ортодонтия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/restavraciya-zubov/"><span>Эстетическая реставрация <br> зубов</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/withe/"><span>Отбеливание зубов</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/paradot/"><span>Пародонтология</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/endodotiya/"><span>Эндодонтия</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/gigi-prof/"><span>Профессиональная гигиена <br> полости рта</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/anestez/"><span>Анестезиология</span></a></div>
                <div class="servises_item"><a class="_menu_link" href="/dent/diagnost/"><span>Диагностика</span></a></div>

            </div>

        </div>

        <div class="contacts_wrapper">

            <a class="_menu_link_no_borders" href="/">
                <div class="logo_wrapper">

                    <div class="logo_img"></div>
                    <div class="logo_name">
                        <p>Центр Стоматологической Имплантологии<br>© 2020</p>
                    </div>

                </div>
            </a>

            <div class="phones">
                <a href="tel:4959302256">+7 (495) 930-22-56</a>
                <a href="tel:4951502716">+7 (495) 150-27-16</a>
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

        <p class="lp_label">Создание&nbsp;и&nbsp;продвижение&nbsp;сайта<br><a class="_link" href="http://liderpoiska.ru/" target="_blank">«Лидер поиска»</a></p>
    </div>

    <div class="layout_popup _hidden">
        <div class="scroll_wrapper"></div>
    </div>

    <div class="reception_form_container _hidden">
        <?= $this->render(
            '../components/reception_form.twig', [
                'clinics' => Yii::$app->params['clinics'],
                'csrf' => Yii::$app->request->getCsrfToken(),
            ]) ?>
    </div>

    <div class="review_form_container _hidden">
        <div class="review_form_wrapper" data-page-type="review_form">
            <?= $this->render('../components/review_form.twig', [
                'in_content_block' => '',
                'csrf' => Yii::$app->request->getCsrfToken(),
            ]) ?>
        </div>
    </div>

</footer>

<!-- Yandex.Metrika counter -->
<noscript><div><img src="https://mc.yandex.ru/watch/24588914" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script src="/node_modules/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="/node_modules/zurb-twentytwenty/js/jquery.event.move.js" type="text/javascript"></script>
<script src="/node_modules/zurb-twentytwenty/js/jquery.twentytwenty.js" type="text/javascript"></script>
