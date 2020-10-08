<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "deals".
 *
 * @property int $deals_id
 * @property string $deals_title
 * @property string $deals_long_title
 * @property string $deals_description
 * @property string $deals_index_description
 * @property string $deals_index_image
 * @property string $alias
 * @property string $deals_image_front
 * @property string $deals_image_back
 * @property string $deals_content
 * @property int $old_id
 */
class Deals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deals_title', 'deals_long_title', 'deals_description', 'deals_image_front', 'deals_image_back', 'deals_content', 'old_id'], 'required'],
            [['deals_title', 'deals_long_title', 'deals_description', 'deals_index_description', 'deals_index_image', 'alias', 'deals_image_front', 'deals_image_back', 'deals_content'], 'string'],
            [['old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'deals_id' => 'ID',
            'deals_title' => 'Название',
            'deals_long_title' => 'Длинное название',
            'deals_description' => 'Описание',
            'deals_index_description' => 'Краткое описание',
            'deals_index_image' => 'Изображение для карточки',
            'alias' => 'Alias',
            'deals_image_front' => 'Deals Image Front',
            'deals_image_back' => 'Изображение для страницы',
            'deals_content' => 'Описание для страницы',
            'old_id' => 'Old ID',
        ];
    }
}
