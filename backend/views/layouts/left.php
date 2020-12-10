<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Услуги', 'icon' => 'circle-o', 'url' => ['/servises']],
                    ['label' => 'Врачи', 'icon' => 'circle-o', 'url' => ['/doctors']],
                    ['label' => 'Специальности', 'icon' => 'circle-o', 'url' => ['/medicalSpecialties']],
                    ['label' => 'Отзывы', 'icon' => 'circle-o', 'url' => ['/reviews']],
                    ['label' => 'FAQ', 'icon' => 'circle-o', 'url' => ['/faq']],
                    ['label' => 'Цены', 'icon' => 'circle-o', 'url' => ['/prices']],
                    ['label' => 'Клиники', 'icon' => 'circle-o', 'url' => ['/clinics']],
                    ['label' => 'Рейтинги', 'icon' => 'circle-o', 'url' => ['/ratings']],
                    ['label' => 'Спецпредложения', 'icon' => 'circle-o', 'url' => ['/deals']],
                    ['label' => 'Баннеры', 'icon' => 'circle-o', 'url' => ['/banners']],
                    ['label' => 'Партнёры', 'icon' => 'circle-o', 'url' => ['/partners-deals']],
                    ['label' => 'Лицензии и документы', 'icon' => 'circle-o', 'url' => ['/licenses-documents-page/']],
                    ['label' => 'SEO для общих страниц', 'icon' => 'circle-o', 'url' => ['/seo-single-pages/']],
                    ['label' => 'Драфты', 'icon' => 'circle-o', 'url' => ['/hc-draft/']],
                    // ['label' => 'Теги', 'icon' => 'circle-o', 'url' => ['/hc-tag/']],
                    ['label' => 'Блоки', 'icon' => 'circle-o', 'url' => ['/hc-block/']],
                ],
            ]
        ) ?>

    </section>

</aside>
