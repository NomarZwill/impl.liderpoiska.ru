<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;
use backend\models\Ratings;
use \common\components\Transliteration;

/**
 * This is the model class for table "clinics".
 *
 * @property int $clinic_id
 * @property string $clinic_title
 * @property string $clinic_long_title
 * @property string $clinic_description
 * @property string $alias
 * @property string $content
 * @property string $clinic_address
 * @property string $clinic_phone
 * @property string $clinic_opening_hours
 * @property string $clinic_map
 * @property string $main_phone
 * @property string $keywords
 * @property string $review_to_filial
 * @property string $review_title
 * @property string $bottom_text
 * @property int $old_id
 */
class Clinics extends \yii\db\ActiveRecord
{

    public $cinic_gallery_images;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clinics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['h1_title'], 'required'],
            [['clinic_title', 'clinic_long_title', 'clinic_description', 'alias', 'card_title', 'h1_title', 'breadcrumbs_title', 'content', 'clinic_address', 'clinic_address_short', 'clinic_address_form', 'clinic_phone', 'clinic_opening_hours', 'clinic_opening_weekdays', 'clinic_opening_sat', 'clinic_opening_sun', 'clinic_map', 'main_phone', 'keywords', 'review_to_filial', 'review_title', 'bottom_text', 'clinic_whatsapp', 'clinic_mail'], 'string'],
            [['old_id', 'is_active', 'clinic_sort'], 'integer'],
            [['cinic_gallery_images'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clinic_id' => 'ID',
            'clinic_title' => 'Название',
            'clinic_long_title' => 'Title',
            'clinic_description' => 'Описание',
            'alias' => 'Alias',
            'card_title' => 'Короткое название для карточек клиник',
            'h1_title' => 'Заголовок h1',
            'breadcrumbs_title' => 'Название в хлебной крошке',
            'is_active' => 'Активный',
            'clinic_sort' => 'Сортировка в листинге клиник',
            'content' => 'Контент',
            'clinic_address' => 'Адрес',
            'clinic_address_short' => 'Короткий адрес для карточек',
            'clinic_phone' => 'Телефоны',
            'clinic_opening_hours' => 'Часы работы',
            'clinic_opening_weekdays' => 'Часы работы в будни',
            'clinic_opening_sat' => 'Часы работы в субботу',
            'clinic_opening_sun' => 'Часы работы в воскресенье',
            'clinic_map' => 'Карта',
            'main_phone' => 'Основной телефон',
            'keywords' => 'Ключевые слова',
            'review_to_filial' => 'Review To Filial',
            'review_title' => 'Review Title',
            'bottom_text' => 'Bottom Text',
            'clinic_whatsapp' => 'Whats app',
            'clinic_mail' => 'Почта',
            'cinic_gallery_images' => 'Загруженное изображение для галереи',
            'old_id' => 'Old ID',
        ];
    }

    public function getSeo(){
        return $seo = [
            'title' => $this->clinic_long_title,
            'desc' => $this->clinic_description,
            'kw' => $this->keywords,
        ];
    }

    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['clinic_id' => 'clinic_id'])
            ->where(['ratings.is_active' => 1]);
    }

    public function getImageGalleries()
    {
        return $this->hasMany(ImageGalleries::className(), ['parent_id' => 'clinic_id'])
            ->where(['parent_type' => 'clinics']);
    }

    public function getReviews()
    {
        $reviews = $this->hasMany(Reviews::className(), ['review_id' => 'review_id'])
            ->viaTable('review_clinic_rel', ['clinic_id' => 'clinic_id'])
            ->where(['reviews.is_active' => 1])
            ->orderBy(['reviews.date' => SORT_DESC]);
          
        return $reviews;
    }

    public function getBunnersForClinics(){
        $bunners =  $this->hasMany(Banners::className(), ['id' => 'banner_id'])
            ->viaTable('banners_and_clinics', ['clinic_id' => 'clinic_id'])
            ->where(['banners.is_active' => 1])
            ->orderBy(['banners.sort' => SORT_ASC]);

        return $bunners;
    }

    public function getArrayToSelect2() {
        $array = [];
        $clinics = Clinics::find()->all();

        foreach ($clinics as $clinic) {
            $array[$clinic->clinic_id] = $clinic->card_title;
        }

        return $array;
    }

    public function uploadImages()
    {
        //if ($this->validate()) {
        $newSortIndex = ImageGalleries::find()
            ->where(['parent_id' => $this->clinic_id, 'parent_type' => 'clinics'])
            ->count();
        $iter = 1;
        foreach ($this->cinic_gallery_images as $file) {
            $path = 'images/uploaded/clinics/'. $this->clinic_id . '/';
            FileHelper::createDirectory($path);
            $file->saveAs($path . time() . '_' . $iter . '.' . $file->extension);
            $gallery = new ImageGalleries();
            $gallery->parent_type = Clinics::tableName();
            $gallery->parent_id = $this->clinic_id;
            $gallery->img_sort = $newSortIndex;
            $gallery->filepath = $path . time() . '_' . $iter . '.' . $file->extension;
            $gallery->save();
            $iter++;  
            $newSortIndex++;   
        }
        return true;
        //} else {
        //    return false;
        //}
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (empty($this->alias)) {
            $this->alias = Transliteration::getTransliteration($this->h1_title);
            $this->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }
}