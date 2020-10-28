<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property string $link_to_agregator
 * @property double $average_rating
 * @property string $clinic_id
 */
class Ratings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'icon', 'link_to_agregator', 'average_rating', 'clinic_id'], 'required'],
            [['name', 'icon', 'link_to_agregator', 'clinic_id'], 'string'],
            [['average_rating'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
            'link_to_agregator' => 'Link To Agregator',
            'average_rating' => 'Average Rating',
            'clinic_id' => 'Clinic ID',
        ];
    }
}
