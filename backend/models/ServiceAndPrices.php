<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_and_prices".
 *
 * @property int $id
 * @property int $service_id
 * @property int $prices_id
 */
class ServiceAndPrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_and_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'prices_id'], 'required'],
            [['service_id', 'prices_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'prices_id' => 'Prices ID',
        ];
    }

    public function getPriceServiceIDs($priceID){
        $priceServiceIDList = [];
        $priceServiceList = ServiceAndPrices::find()->where(['prices_id' => $priceID])->all();

        foreach ($priceServiceList as $item) {
            $priceServiceIDList[] = $item->service_id;
        }
        return $priceServiceIDList;
            
    }
}
