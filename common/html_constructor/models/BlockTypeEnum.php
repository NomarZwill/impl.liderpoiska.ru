<?php

namespace common\html_constructor\models;

use common\html_constructor\models\utility\BaseEnum;

abstract class BlockTypeEnum extends BaseEnum
{

    const Text = 'text';
    const File = 'media';
    const Layout = 'layout';
    const Custom = 'custom';

    const LABEL_MAP = [
        self::Text => 'Текстовые блоки',
        self::File => 'Блоки с файлами',
        self::Layout => 'Разметка',
        self::Custom => 'Вставка',
    ];


    public static function getLabel($type)
    {
        if (self::isValidValue($type)) {
            return self::LABEL_MAP[$type];
        } else return 'Название не определено';
    }

}
