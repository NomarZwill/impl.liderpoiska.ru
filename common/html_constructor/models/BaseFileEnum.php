<?php

namespace common\html_constructor\models;

use common\html_constructor\models\utility\BaseEnum;
use common\html_constructor\models\HcDraft;
use common\html_constructor\models\HcDraftBlock;
use common\html_constructor\models\HcTag;
use yii\helpers\Json;

abstract class BaseFileEnum extends BaseEnum
{
    const PHOTO = 'photo';
    const IMAGE = 'image';
    const HTML = 'html';

    const LABEL_MAP = [
        self::PHOTO => 'Фото',
        self::IMAGE => 'Изображение',
    ];

    /**
     * @return string[]
     */
    public static function getFileTypes() {
        return [];
    }

    /**
     * @return string[]
     *получаем доступные для объекта алиасы целей прикрепления файлов ['image', 'logo', ...]
     */
    public static function getForHcObject($model)
    {
        $definedTypes = static::getFileTypes();
        if(isset($definedTypes[$model::className()])) {
            return $definedTypes[$model::className()];
        }
        switch ($model::className()) {
            case HcDraft::class:
                return [self::IMAGE];
                break;
                
            case HcTag::class:
                return [self::IMAGE];
                break;
            //у блока поста склеиваем типинпута_slug. Это и будет алиас
            case HcDraftBlock::class:
                $filetargets = [];
                foreach (Json::decode($model->hcBlock->inputs) as $inputName => $inputs) {
                    if (self::isValidValue($inputName)) {
                        $filetargets = array_reduce($inputs, function ($acc, $inputinfo) use ($inputName) {
                            if (!empty($inputinfo['slug'])) {
                                $acc[] = $inputName . '_' . $inputinfo['slug'];
                            }
                            return $acc;
                        }, $filetargets);
                    }
                }
                return $filetargets;
                break;
            default:
                return [];
                break;
        }
    }

    public static function getLabel($type)
    {
        if (self::isValidValue($type)) {
            return static::LABEL_MAP[$type] ?? self::LABEL_MAP[$type] ?? '???';
        } else return 'Тип не определен';
    }
}
