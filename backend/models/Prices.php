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

    public $price_services_rel;
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
            [['prices_name', 'price'], 'required'],
            [['prices_name', 'keywords', 'prices_description', 'code', 'alias'], 'string'],
            [['price', 'price_hide', 'is_active', 'old_id'], 'integer'],
            [['price_services_rel'], 'safe'],
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
            'price' => 'Стоимость',
            'price_hide' => 'Стоимость со скидкой',
            'keywords' => 'Ключевые слова',
            'prices_description' => 'Описание',
            'is_active' => 'Активен',
            'code' => 'Код',
            'alias' => 'Alias',
            'price_services_rel' => 'Выбор услуг',
            'old_id' => 'Old ID',
        ];
    }

    public function afterSave($insert, $changedAttributes){

        if (!empty($this->price_services_rel)) {

            // удаление стёртых значений
            foreach (ServiceAndPrices::find()->where(['prices_id' => $this->prices_id])->all() as $item) {
                if (array_search($item->service_id, $this->price_services_rel) === false) {
                    $item->delete();
                    // echo $item->service_id . ' deleted, ';
                }
            }
            
            // добавление вновь выбранных значений
            foreach ($this->price_services_rel as $service) {
                $priceService = new ServiceAndPrices();
                $priceService->prices_id = $this->prices_id;
                $priceService->service_id = $service;
                if (!ServiceAndPrices::find()->where(['prices_id' => $this->prices_id, 'service_id' => $service])->exists()) {
                    $priceService->save();
                    // echo $priceService->service_id . ' saved, ';
                }
            }
        } else {
            
            foreach (ServiceAndPrices::find()->where(['prices_id' => $this->prices_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
