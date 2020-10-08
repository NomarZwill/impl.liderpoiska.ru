<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Услуги', 'icon' => 'circle-o', 'url' => ['/servises']],
                    ['label' => 'Цены', 'icon' => 'circle-o', 'url' => ['/prices']],
                    ['label' => 'Врачи', 'icon' => 'circle-o', 'url' => ['/doctors']],
                    ['label' => 'Клиники', 'icon' => 'circle-o', 'url' => ['/clinics']],
                    ['label' => 'Спецпредложения', 'icon' => 'circle-o', 'url' => ['/deals']],
                    ['label' => 'Отзывы', 'icon' => 'circle-o', 'url' => ['/reviews']],
                    ['label' => 'FAQ', 'icon' => 'circle-o', 'url' => ['/faq']],
                ],
            ]
        ) ?>

    </section>

</aside>
