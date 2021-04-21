<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string $text
 * @property string $image
 * @property string $link_to_deal
 */
class Banners extends \yii\db\ActiveRecord
{
    public $banner_image_load;
    public $banner_clinic_rel;
    public $banner_service_rel;
    public $banner_csrf;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_active', 'is_form_button', 'sort'], 'integer'],
            [['header', 'text', 'image', 'button_label', 'link_to_deal'], 'string'],
            [['banner_image_load', 'banner_clinic_rel', 'banner_service_rel', 'banner_csrf'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Заголовок',
            'text' => 'Текст под заголовком',
            'image' => 'Изображение',
            'button_label' => 'Текст кнопки',
            'link_to_deal' => 'Ссылка на страницу спецпредложения',
            'banner_image_load' => 'Изображение',
            'banner_clinic_rel' => 'Клиники',
            'banner_service_rel' => 'Корневые разделы услуг',
            'is_active' => 'Активен',
            'is_form_button' => 'Кнопка открывает форму записи',
            'sort' => 'Сортировка',
            'banner_csrf' => '',
        ];
    }

    public function uploadImage()
    {
        if ($this->validate()) {

            if (!empty($this->banner_image_load)) {
                
                foreach ($this->banner_image_load as $file) {
                    $path = 'images/uploaded/banners/'. $this->id . '/';
                    FileHelper::createDirectory($path);
                    $file->saveAs($path . time() . '.' . $file->extension);
                    $this->image = time() . '.' . $file->extension;
                }
            }
            return true;
        } else {
            return $this->validate();
        }
    }

    public function updateClinicRelation()
    {
        if (!empty($this->banner_clinic_rel)) {
    
            foreach (BannersAndClinics::find()->where(['banner_id' => $this->id])->all() as $item) {
                if (array_search($item->clinic_id, $this->banner_clinic_rel) === false) {
                    $item->delete();
                }
            }
            
            foreach ($this->banner_clinic_rel as $clinic) {
                $bannerClinic = new BannersAndClinics();
                $bannerClinic->banner_id = $this->id;
                $bannerClinic->clinic_id = $clinic;
                if (!BannersAndClinics::find()->where(['banner_id' => $this->id, 'clinic_id' => $clinic])->exists()) {
                    $bannerClinic->save();
                }
            }
        } else {
            
            foreach (BannersAndClinics::find()->where(['banner_id' => $this->id])->all() as $item) {
                $item->delete();
            }
        }
    }

    public function updateRootServicesRelation()
    {

        if (!empty($this->banner_service_rel)) {
    
            foreach (BannersAndServices::find()->where(['banner_id' => $this->id])->all() as $item) {
                if (array_search($item->service_id, $this->banner_service_rel) === false) {
                    $item->delete();
                }
            }
            
            foreach ($this->banner_service_rel as $service) {
                $bannerService = new BannersAndServices();
                $bannerService->banner_id = $this->id;
                $bannerService->service_id = $service;
                if (!BannersAndServices::find()->where(['banner_id' => $this->id, 'service_id' => $service])->exists()) {
                    $bannerService->save();
                }
            }
        } else {
            
            foreach (BannersAndServices::find()->where(['banner_id' => $this->id])->all() as $item) {
                $item->delete();
            }
        }
    }


    public function afterSave($insert, $changedAttributes)
    {
        Banners::updateClinicRelation();
        Banners::updateRootServicesRelation();

        parent::afterSave($insert, $changedAttributes);
    }

}
