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
            [['deals_title', 'deals_long_title', 'deals_description', 'deals_image_front', 'deals_image_back', 'deals_content'], 'string'],
            [['old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'deals_id' => 'Deals ID',
            'deals_title' => 'Deals Title',
            'deals_long_title' => 'Deals Long Title',
            'deals_description' => 'Deals Description',
            'deals_image_front' => 'Deals Image Front',
            'deals_image_back' => 'Deals Image Back',
            'deals_content' => 'Deals Content',
            'old_id' => 'Old ID',
        ];
    }
}
