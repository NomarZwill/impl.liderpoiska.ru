<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banners_and_services".
 *
 * @property int $id
 * @property int $banner_id
 * @property int $service_id
 */
class BannersAndServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners_and_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['banner_id', 'service_id'], 'required'],
            [['banner_id', 'service_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banner_id' => 'Banner ID',
            'service_id' => 'Service ID',
        ];
    }

    public function getBannersServiceIDs($bannerID){
        $bannerServiceIDList = [];
        $bannerServiceList = BannersAndServices::find()->where(['banner_id' => $bannerID])->all();

        foreach ($bannerServiceList as $item) {
            $bannerServiceIDList[] = $item->service_id;
        }
        return $bannerServiceIDList;
            
    }
}
