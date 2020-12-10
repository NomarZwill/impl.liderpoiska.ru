<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banners_and_clinics".
 *
 * @property int $id
 * @property int $banner_id
 * @property int $clinic_id
 */
class BannersAndClinics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners_and_clinics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['banner_id', 'clinic_id'], 'required'],
            [['banner_id', 'clinic_id'], 'integer'],
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
            'clinic_id' => 'Clinic ID',
        ];
    }

    public function getBannersClinicIDs($bannerID){
        $bannerClinicIDList = [];
        $bannerClinicList = BannersAndClinics::find()->where(['banner_id' => $bannerID])->all();

        foreach ($bannerClinicList as $item) {
            $bannerClinicIDList[] = $item->clinic_id;
        }
        return $bannerClinicIDList;
            
    }
}
