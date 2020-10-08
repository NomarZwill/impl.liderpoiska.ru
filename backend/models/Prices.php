<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "prices".
 *
 * @property int $prices_id
 * @property string $prices_name
 * @property int $price
 * @property string $price_hide
 * @property string $keywords
 * @property string $code
 * @property string $alias
 * @property int $old_id
 */
class Prices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prices_name', 'price', 'alias', 'old_id'], 'required'],
            [['prices_name', 'price_hide', 'keywords', 'code', 'alias'], 'string'],
            [['price', 'old_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prices_id' => 'ID',
            'prices_name' => 'Название услуги',
            'price' => 'Цена',
            'price_hide' => 'Price Hide',
            'keywords' => 'Ключевые слова',
            'code' => 'Код',
            'alias' => 'Alias',
            'old_id' => 'Old ID',
        ];
    }
}
