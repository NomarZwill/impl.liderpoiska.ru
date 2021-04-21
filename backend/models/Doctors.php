<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use \common\html_constructor\models\HcDraft;
use \common\components\Transliteration;

/**
 * This is the model class for table "doctors".
 *
 * @property int $doctor_id
 * @property string $doctor_title
 * @property string $doctor_long_title
 * @property string $doctor_description
 * @property string $introtext
 * @property string $alias
 * @property string $doctor_outer_links
 * @property string $content
 * @property string $doctor_education
 * @property string $doctor_image
 * @property string $medic_to_filial
 * @property string $sort_lab_smail
 * @property string $sort_doyche_velle
 * @property string $sort_esteticheskaya_stomatologiya_chistie_prudi
 * @property string $sort_esteticheskaya_stomatologiya
 * @property string $sort_impl
 * @property string $sort_centr_implantologii
 * @property string $review_to_specials
 * @property string $specials_to_medic
 * @property string $review_title
 * @property string $query_to_service
 * @property string $faq_title
 * @property string $sort_klinika_dentalgeneva
 * @property string $sort_prec_1005
 * @property string $sort_prec_1154
 * @property string $sort_prec_1459
 * @property string $sort_prec_988
 * @property string $sort_prec_989
 * @property string $sort_prec_990
 * @property string $sort_prec_991
 * @property string $sort_prec_992
 * @property string $sort_prec_994
 * @property int $old_id
 */
class Doctors extends \yii\db\ActiveRecord
{
    public $doctor_image_load;
    public $doctor_spec_rel;
    public $doctor_spec_sort;
    public $doctor_clinic_rel;
    public $doctor_clinic_sort;
    public $doctor_service_rel;
    public $doctor_service_sort;
    public $doctor_video_links;
    public $doctor_new_video_links;
    public $doctor_lizcenz_gallery;
    public $article_doctor_rel;
    public $article_doctor_sort;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['doctor_title', 'doctor_long_title', 'doctor_description', 'alias', 'content', 'doctor_education', 'doctor_image', 'old_id'], 'required'],
            [['doctor_title', 'doctor_long_title', 'doctor_description','keywords', 'breadcrumbs_title', 'introtext', 'alias', 'doctor_outer_links', 'content', 'doctor_education', 'doctor_image', 'medic_to_filial', 'sort_lab_smail', 'sort_doyche_velle', 'sort_esteticheskaya_stomatologiya_chistie_prudi', 'sort_esteticheskaya_stomatologiya', 'sort_impl', 'sort_centr_implantologii', 'review_to_specials', 'specials_to_medic', 'review_title', 'query_to_service', 'faq_title', 'sort_klinika_dentalgeneva', 'sort_prec_1005', 'sort_prec_1154', 'sort_prec_1459', 'sort_prec_988', 'sort_prec_989', 'sort_prec_990', 'sort_prec_991', 'sort_prec_992', 'sort_prec_994'], 'string'],
            [['old_id', 'doctor_experience', 'answers_the_questions', 'visible_on_home_page', 'is_active', 'doctor_listing_sort'], 'integer'],
            [['doctor_image_load', 'doctor_spec_rel', 'doctor_spec_sort', 'doctor_clinic_rel', 'doctor_clinic_sort', 'doctor_service_rel', 'doctor_service_sort', 'doctor_video_links', 'doctor_new_video_links', 'doctor_lizcenz_gallery', 'article_doctor_rel', 'article_doctor_sort'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doctor_id' => 'ID',
            'doctor_title' => 'ФИО врача (h1 на странице доктора)',
            'doctor_long_title' => 'Title',
            'doctor_description' => 'Краткое описание',
            'keywords' => 'Ключевые слова',
            'breadcrumbs_title' => 'Название в хлебной крошке',
            'introtext' => 'Introtext',
            'alias' => 'Alias',
            'doctor_outer_links' => 'Внешние ссылки (через запятую)',
            'is_active' => 'Активен',
            'content' => 'Контент',
            'doctor_education' => 'Образование',
            'doctor_experience' => 'Опыт работы',
            'doctor_image' => 'Фото врача',
            'answers_the_questions' => 'Отвечает на вопросы',
            'visible_on_home_page' => 'Виден на главной странице',
            'medic_to_filial' => 'Medic To Filial',
            'sort_lab_smail' => 'Sort Lab Smail',
            'sort_doyche_velle' => 'Sort Doyche Velle',
            'sort_esteticheskaya_stomatologiya_chistie_prudi' => 'Sort Esteticheskaya Stomatologiya Chistie Prudi',
            'sort_esteticheskaya_stomatologiya' => 'Sort Esteticheskaya Stomatologiya',
            'sort_impl' => 'Sort Impl',
            'sort_centr_implantologii' => 'Sort Centr Implantologii',
            'review_to_specials' => 'Review To Specials',
            'specials_to_medic' => 'Specials To Medic',
            'review_title' => 'Заголовок для отзывов',
            'query_to_service' => 'Query To Service',
            'faq_title' => 'Заголовок для FAQ',
            'sort_klinika_dentalgeneva' => 'Sort Klinika Dentalgeneva',
            'sort_prec_1005' => 'Sort Prec 1005',
            'sort_prec_1154' => 'Sort Prec 1154',
            'sort_prec_1459' => 'Sort Prec 1459',
            'sort_prec_988' => 'Sort Prec 988',
            'sort_prec_989' => 'Sort Prec 989',
            'sort_prec_990' => 'Sort Prec 990',
            'sort_prec_991' => 'Sort Prec 991',
            'sort_prec_992' => 'Sort Prec 992',
            'sort_prec_994' => 'Sort Prec 994',
            'old_id' => 'Old ID',
            'doctor_spec_rel' => 'Специальности врача',
            'doctor_spec_sort' => 'Сортировка на странице специальности врача',
            'doctor_clinic_rel' => 'Клиники приёма',
            'doctor_clinic_sort' => 'Сортировка на странице клиники',
            'doctor_service_rel' => 'Услуги врача',
            'doctor_service_sort' => 'Сортировка на странице услуги',
            'doctor_listing_sort' => 'Позиция на странице листинга врачей',
            'doctor_image_load' => 'Фото врача',
            'doctor_new_video_links' => 'Добывить ссылки на видео',
            'doctor_video_links' => 'Cсылки на видео',
            'doctor_lizcenz_gallery' => 'Галерея лицензий',
            'article_doctor_rel' => 'Связанные статьи',
            'article_doctor_sort' => 'Сортировка на странице статьи',
        ];
    }

    public function getMicroData($doc){

        $medSpecs = [];

        foreach ($doc->medicalSpecialties as $medSpec) {
            array_push($medSpecs, 
                [
                    "@type" => "MedicalSpecialty",
                    "name" => $medSpec->menu_title
                ]
            );  
        }

        $addresses = [];

        foreach ($doc->doctorsAndClinics as $clinic) {
            $phones = explode('+', strip_tags($clinic->clinic_phone));

            foreach ($phones as $key => $phone) {

                if ($phones[$key] !== '') {
                    $phones[$key] = '+' . $phone;
                }
            }

            if ($clinic->clinic_id !== 5) {

                $address = explode(',', strip_tags($clinic->clinic_address));
                $tmp = explode(' ', str_replace('&nbsp;', ' ', $address[3]));
                $streetAddress = $address[2] . ', д. ' . $tmp[2];    

                array_push($addresses, 
                    [
                        "@type" => "PostalAddress",
                        "streetAddress" => $streetAddress,
                        "addressLocality" => "Москва",
                        "postalCode" => $address[0],
                        "addressCountry" => [
                            "@type" => "Country",
                            "name" => "Россия",
                        ],
                        "telephone" => $phones,
                    ]
                );  
            } else {

                array_push($addresses, 
                    [
                        "@type" => "PostalAddress",
                        "streetAddress" => "Boulevard James-Fazy 4",
                        "addressLocality" => "Geneva",
                        "postalCode" => 1201,
                        "addressCountry" => [
                            "@type" => "Country",
                            "name" => "Switzerland",
                        ],
                        "telephone" => $phones,
                    ]
                ); 
            }
        }

        $outerLinks = [];
        
        if ($doc->doctor_outer_links !== null) {
            $outerLinks = explode(',', $doc->doctor_outer_links);
        }

        $finalJSON = Html::script(
            Json::encode([
            "@context" => "https://schema.org/",
            "@type" => "Dentist",
            "name" => $doc->doctor_title,
            "url" => "https://www.impl.ru/specialists/" . $doc->alias . "/",
            "description" => $doc->doctor_description,
            "award" => strip_tags($doc->doctor_education),
            "MedicalSpecialty" => $medSpecs,
            "Image" => "https://www.impl.ru/images/uploaded/doctors/" . $doc->doctor_id . "/" . $doc->doctor_image,
            "address" => $addresses,
            "priceRange" => "$",
            "sameAs" => $outerLinks,
            ]), [
            'type' => 'application/ld+json',
        ]);

        return $finalJSON;
    }


    public function getSeo(){
        return $seo = [
            'title' => $this->doctor_long_title,
            'desc' => $this->doctor_description,
            'kw' => $this->keywords,
        ];
    }

    public function getMedicalSpecialties(){
        return $this->hasMany(MedicalSpecialties::className(), ['specialty_id' => 'specialty_id'])
            ->viaTable('doctors_med_spec', ['doctor_id' => 'doctor_id']);
    }

    public function getdoctorsHcDraft(){
        return $this->hasMany(HcDraft::className(), ['id' => 'hc_draft_id'])
            ->viaTable('doctors_hc_draft', ['hc_draft_id' => 'doctor_id']);
    }

    public function getDoctorsAndClinics(){
        return $this->hasMany(Clinics::className(), ['clinic_id' => 'clinic_id'])
            ->viaTable('doctors_and_clinics', ['doctor_id' => 'doctor_id']);
    }

    public function getReviews(){
        $reviews = $this->hasMany(Reviews::className(), ['review_id' => 'review_id'])
            ->viaTable('review_doctors_rel', ['doctor_id' => 'doctor_id'])
            ->where(['reviews.is_active' => 1])
            ->orderBy(['reviews.date' => SORT_DESC]);

        return $reviews;
    }

    public function getArrayToSelect2($answersTheQuestions = false) {
        $array = [];

        if ($answersTheQuestions) {
            $doctors = Doctors::find()->where(['answers_the_questions' => 1])->all();
        } else {
            $doctors = Doctors::find()->all();
        }
        
        foreach ($doctors as $doctor) {
            $array[$doctor->doctor_id] = $doctor->doctor_title;
        }

        return $array;
    }

    public function getDoctorsPageSort(){
        return $this->hasMany(DoctorsPageSort::className(), ['doctor_id' => 'doctor_id']);
    }

    public function getDoctorsGalleries(){
        return $this->hasMany(DoctorsPageGalleries::className(), ['doctor_id' => 'doctor_id']);
            
    }

    public function getDoctorsVideos(){
        $videos = $this->hasMany(DoctorsPageGalleries::className(), ['doctor_id' => 'doctor_id'])
            ->where(['block_type' => 'video']);
        return $videos;
    }

    public function getDoctorsLizenzes(){
        $lizenzes = $this->hasMany(DoctorsPageGalleries::className(), ['doctor_id' => 'doctor_id'])
            ->where(['block_type' => 'lizcenz']);
        return $lizenzes;
    }

    public function uploadImage()
    {
        if ($this->validate()) {

            if (!empty($this->doctor_image_load)) {
                
                foreach ($this->doctor_image_load as $file) {
                    $path = 'images/uploaded/doctors/'. $this->doctor_id . '/';
                    FileHelper::createDirectory($path);
                    $file->saveAs($path . time() . '.' . $file->extension);
                    $this->doctor_image = time() . '.' . $file->extension;
                }
            }

            if (!empty($this->doctor_lizcenz_gallery)) {

                $iter = 1;
                foreach ($this->doctor_lizcenz_gallery as $file) {
                    $path = 'images/uploaded/doctors/'. $this->doctor_id . '/lizcenz/';
                    FileHelper::createDirectory($path);
                    $file_name = time() . '_' . $iter . '.' . $file->extension;
                    $file->saveAs($path . $file_name);

                    $alias_front = Yii::getAlias('@frontend/web');
                    Image::getImagine()
                        ->open($alias_front . '/' . $path . $file_name)
                        ->thumbnail(new Box(192, 270))
                        ->save($alias_front . '/' . $path . 'thumbnail_' . $file_name , ['quality' => 90]);

                    $gallery = new DoctorsPageGalleries();
                    $gallery->doctor_id = $this->doctor_id;
                    $gallery->block_type = 'lizcenz';
                    $gallery->filepath = $file_name;
                    $gallery->save();
                    $iter++;     
                }
            }

            return true;
        } else {
            return $this->validate();
        }
    }

    public function modifyExperienceString(&$doctors){

        foreach ($doctors as $doctor){
            $doctor->doctor_experience = Doctors::num_decline($doctor->doctor_experience);
        }
    }

    public function num_decline($number){
        $titles = [ 
            0 => 'год',
            1 => 'года',
            2 => 'лет',
        ];
        $cases = [ 2, 0, 1, 1, 1, 2 ];
        $intnum = abs( intval( strip_tags( $number ) ) );
    
        return "$number ". $titles[ ($intnum % 100 > 4 && $intnum % 100 < 20) ? 2 : $cases[min($intnum % 10, 5)] ];
    }

    public function addNewVideo(){

        if (!empty($this->doctor_new_video_links)) {
    
            foreach ($this->doctor_new_video_links as $video) {
                $doctorVideo = new DoctorsPageGalleries();
                $doctorVideo->doctor_id = $this->doctor_id;
                $doctorVideo->block_type = 'video';
                $doctorVideo->filepath = $video;
                if (!DoctorsPageGalleries::find()->where(['doctor_id' => $this->doctor_id, 'filepath' => $video, 'block_type' => 'video'])->exists()) {
                    $doctorVideo->save();
                }
            }
        }
    }

    public function updateVideoList(){
        if (!empty($this->doctor_video_links)) {
    
            // удаление стёртых значений из таблицы 
            foreach (DoctorsPageGalleries::find()->where(['doctor_id' => $this->doctor_id, 'block_type' => 'video'])->all() as $item) {
                if (array_search($item->id, $this->doctor_video_links) === false) {
                    $item->delete();
                }
            }
            
        } else {
            
            foreach (DoctorsPageGalleries::find()->where(['doctor_id' => $this->doctor_id, 'block_type' => 'video'])->all() as $item) {
                $item->delete();
            }
        }
    }

    public function updateSpecRelations(){

        // обработка данных о связях со специальностями
        if (!empty($this->doctor_spec_rel)) {

            // удаление стёртых значений из таблицы доктор-специальность
            foreach (DoctorsMedSpec::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                if (array_search($item->specialty_id, $this->doctor_spec_rel) === false) {
                    $item->delete();
                }
            }

            foreach ($this->doctor_spec_rel as $spec) {
                $doctorMedSpec = new DoctorsMedSpec();
                $doctorMedSpec->doctor_id = $this->doctor_id;
                $doctorMedSpec->specialty_id = $spec;
                if (!DoctorsMedSpec::find()->where(['doctor_id' => $this->doctor_id, 'specialty_id' => $spec])->exists()) {
                    $doctorMedSpec->save();
                    // echo $doctorMedSpec->specialty_id . ' saved, ';
                }
            }
        } else {
            
            foreach (DoctorsMedSpec::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }
    }

    public function updateClinicRelations(){

        if (!empty($this->doctor_clinic_rel)) {
    
            foreach (DoctorsAndClinics::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                if (array_search($item->clinic_id, $this->doctor_clinic_rel) === false) {
                    $item->delete();
                    // echo $item->clinic_id . ' deleted, ';
                }
            }
            
            foreach ($this->doctor_clinic_rel as $clinic) {
                $doctorClinic = new DoctorsAndClinics();
                $doctorClinic->doctor_id = $this->doctor_id;
                $doctorClinic->clinic_id = $clinic;
                if (!DoctorsAndClinics::find()->where(['doctor_id' => $this->doctor_id, 'clinic_id' => $clinic])->exists()) {
                    $doctorClinic->save();
                    // echo $doctorClinic->clinic_id . ' saved, ';
                }
            }
        } else {
            
            foreach (DoctorsAndClinics::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }
    }

    public function updateServicesRelations(){
        if (!empty($this->doctor_service_rel)) {
    
            // удаление стёртых значений

            foreach (DoctorsServicesRel::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                if (array_search($item->service_id, $this->doctor_service_rel) === false) {
                    $item->delete();
                    // echo $item->service_id . ' deleted, ';
                }
            }
            
            // добавление вновь выбранных значений
            foreach ($this->doctor_service_rel as $service) {
                $doctorService = new DoctorsServicesRel();
                $doctorService->doctor_id = $this->doctor_id;
                $doctorService->service_id = $service;
                if (!DoctorsServicesRel::find()->where(['doctor_id' => $this->doctor_id, 'service_id' => $service])->exists()) {
                    $doctorService->save();
                    // echo $doctorService->service_id . ' saved, ';
                }

                //создание новых записей в сортировочной таблице
                $doctorServiceSort = new DoctorsPageSort();
                $doctorServiceSort->doctor_id = $this->doctor_id;
                $doctorServiceSort->page_type = 'services';
                $doctorServiceSort->page_id = $service;
                $doctorServiceSort->sort_index = 0;
                if (!DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_type' => 'services', 'page_id' => $service])->exists()) {
                    $doctorServiceSort->save();
                }
            }
        } else {
            
            foreach (DoctorsServicesRel::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                $item->delete();
                // echo $item->service_id . ' deleted, ';
            }
        }
    }

    public function updateArticleRelations(){

        if (!empty($this->article_doctor_rel)) {
    
            foreach (ArticlesDoctorsRel::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                if (array_search($item->article_id, $this->article_doctor_rel) === false) {
                    $item->delete();
                    DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $item->article_id, 'page_type' => 'articles'])->one()->delete();
                }
            }
            
            foreach ($this->article_doctor_rel as $article) {
                $doctorArticle = new ArticlesDoctorsRel();
                $doctorArticle->doctor_id = $this->doctor_id;
                $doctorArticle->article_id = $article;
                if (!ArticlesDoctorsRel::find()->where(['doctor_id' => $this->doctor_id, 'article_id' => $article])->exists()) {
                    $doctorArticle->save();
                }
            }
        } else {
            
            foreach (ArticlesDoctorsRel::find()->where(['doctor_id' => $this->doctor_id])->all() as $item) {
                $item->delete();
            }
        }
    }

    public function updateSpecSort(){
        if (!empty($this->doctor_spec_sort) && !empty($this->doctor_spec_rel)) {
            // echo '<pre>';
            // print_r($this->doctor_spec_sort);
            // echo count($this->doctor_spec_sort);
            // exit;

            // if (count($this->doctor_spec_rel) > 1) {
            if (count($this->doctor_spec_sort) === 1) {

                foreach ($this->doctor_spec_sort[array_key_first($this->doctor_spec_sort)] as $key => $value) {
    
                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'medSpeciality'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'medSpeciality'])->one();
    
                        if ($currentSortItem->sort_index === $value) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value;
                            $currentSortItem->save();
                        }
                    } else {
                        $doctorSpecSort = new DoctorsPageSort();
                        $doctorSpecSort->doctor_id = $this->doctor_id;
                        $doctorSpecSort->page_type = 'medSpeciality';
                        $doctorSpecSort->page_id = $key;
                        $doctorSpecSort->sort_index = $value;
                        $doctorSpecSort->save();
                    }
                }
            } else {

                foreach ($this->doctor_spec_sort as $key => $value) {

                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'medSpeciality'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'medSpeciality'])->one();

                        if ($currentSortItem->sort_index === $value[0]) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value[0];
                            $currentSortItem->save();
                        }
                    } else {
                        $doctorSpecSort = new DoctorsPageSort();
                        $doctorSpecSort->doctor_id = $this->doctor_id;
                        $doctorSpecSort->page_type = 'medSpeciality';
                        $doctorSpecSort->page_id = $key;
                        $doctorSpecSort->sort_index = isset($value[0]) ? $value[0] : 0;
                        $doctorSpecSort->save();
                    }
                }

            }

            // при удалении связи доктор-специальность, удаляется запись из таблицы сортировки докторов
            foreach (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_type' => 'medSpeciality'])->all() as $item) {
                if (array_search($item->page_id, $this->doctor_spec_rel) === false) {
                    $item->delete();
                }
            }
        }
    }

    public function updateServicesSort(){

        if (!empty($this->doctor_service_sort) && !empty($this->doctor_service_rel)) {

            // echo '<pre>';
            // print_r($this->doctor_service_rel);
            // exit;

            if (count($this->doctor_service_rel) > 1) {

                foreach ($this->doctor_service_sort[array_key_first($this->doctor_service_sort)] as $key => $value) {
    
                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'services'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'services'])->one();
    
                        if ($currentSortItem->sort_index === $value) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value;
                            $currentSortItem->save();
                        }
                    } else {
                        $doctorServiceSort = new DoctorsPageSort();
                        $doctorServiceSort->doctor_id = $this->doctor_id;
                        $doctorServiceSort->page_type = 'services';
                        $doctorServiceSort->page_id = $key;
                        $doctorServiceSort->sort_index = $value;
                        $doctorServiceSort->save();
                    }
                }
            } else {

                foreach ($this->doctor_service_sort as $key => $value) {
    
                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'services'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'services'])->one();
    
                        if ($currentSortItem->sort_index === $value[0]) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value[0];
                            $currentSortItem->save();
                        }
                    } else {
                        // echo '<pre>';
                        // print_r($this->doctor_service_sort);
                        // exit;
                        $doctorServiceSort = new DoctorsPageSort();
                        $doctorServiceSort->doctor_id = $this->doctor_id;
                        $doctorServiceSort->page_type = 'services';
                        $doctorServiceSort->page_id = $key;
                        $doctorServiceSort->sort_index = isset($value[0]) ? $value[0] : 0;
                        $doctorServiceSort->save();
                    }
                }
            }

            // при удалении связи доктор-услуга, удаляется запись из таблицы сортировки докторов
            foreach (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_type' => 'services'])->all() as $item) {
                if (array_search($item->page_id, $this->doctor_service_rel) === false) {
                    $item->delete();
                }
            }
        }
    }

    public function updateClinicSort(){
        if (!empty($this->doctor_clinic_sort) && !empty($this->doctor_clinic_rel)) {
    
            if (count($this->doctor_clinic_rel) > 1) {

                foreach ($this->doctor_clinic_sort[array_key_first($this->doctor_clinic_sort)] as $key => $value) {
    
                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'clinics'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'clinics'])->one();
    
                        if ($currentSortItem->sort_index === $value) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value;
                            $currentSortItem->save();
                        }
                    } else {
                        $doctorClinicSort = new DoctorsPageSort();
                        $doctorClinicSort->doctor_id = $this->doctor_id;
                        $doctorClinicSort->page_type = 'clinics';
                        $doctorClinicSort->page_id = $key;
                        $doctorClinicSort->sort_index = $value;
                        $doctorClinicSort->save();
                    }
                }
            } else {

                foreach ($this->doctor_clinic_sort as $key => $value) {
    
                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'clinics'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'clinics'])->one();
    
                        if ($currentSortItem->sort_index === $value[0]) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value[0];
                            $currentSortItem->save();
                        }
                    } else {
                        $doctorClinicSort = new DoctorsPageSort();
                        $doctorClinicSort->doctor_id = $this->doctor_id;
                        $doctorClinicSort->page_type = 'clinics';
                        $doctorClinicSort->page_id = $key;
                        $doctorClinicSort->sort_index = isset($value[0]) ? $value[0] : 0;
                        $doctorClinicSort->save();
                    }
                }
            }

            // при удалении связи доктор-клиника, удаляется запись из таблицы сортировки докторов
            foreach (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_type' => 'clinics'])->all() as $item) {
                if (array_search($item->page_id, $this->doctor_clinic_rel) === false) {
                    $item->delete();
                }
            }
        }
    }

    public function updateArticleSort(){
        if (!empty($this->article_doctor_sort) && !empty($this->article_doctor_rel)) {
            
            if (array_key_exists(0, $this->article_doctor_sort) && !empty($this->article_doctor_sort[0]) && count($this->article_doctor_rel) > 1) {

                // echo '<pre>';
                // echo 'first';
                // print_r($this->article_doctor_sort);
                // exit;

                foreach ($this->article_doctor_sort[array_key_first($this->article_doctor_sort)] as $key => $value) {
    
                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'articles'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'articles'])->one();
                        
                        if ($currentSortItem->sort_index === $value) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value;
                            $currentSortItem->save();
                        }
                    } else {
                        $doctorArticleSort = new DoctorsPageSort();
                        $doctorArticleSort->doctor_id = $this->doctor_id;
                        $doctorArticleSort->page_type = 'articles';
                        $doctorArticleSort->page_id = $key;
                        $doctorArticleSort->sort_index = $value;
                        $doctorArticleSort->save();
                    }
                }
            } elseif (count($this->article_doctor_sort) === 1 && !array_key_exists(0, $this->article_doctor_sort)) {

                // echo '<pre>';
                // echo 'second';
                // print_r($this->article_doctor_sort);
                // exit;

                foreach ($this->article_doctor_sort as $key => $value) {
    
                    if (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'articles'])->exists()) {
                        $currentSortItem = DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_id' => $key, 'page_type' => 'articles'])->one();
    
                        if ($currentSortItem->sort_index === $value[0]) {
                            break;
                        } else {
                            $currentSortItem->sort_index = $value[0];
                            $currentSortItem->save();
                        }
                    } else {
                        $doctorArticleSort = new DoctorsPageSort();
                        $doctorArticleSort->doctor_id = $this->doctor_id;
                        $doctorArticleSort->page_type = 'articles';
                        $doctorArticleSort->page_id = $key;
                        $doctorArticleSort->sort_index = isset($value[0]) ? $value[0] : 0;
                        $doctorArticleSort->save();
                    }
                }
            } 
        } else if (empty($this->article_doctor_rel)){
            // при удалении связи доктор-статья, удаляется запись из таблицы сортировки докторов
            foreach (DoctorsPageSort::find()->where(['doctor_id' => $this->doctor_id, 'page_type' => 'articles'])->all() as $item) {
                // if (array_search($item->page_id, $this->article_doctor_rel) === false) {
                    $item->delete();
                // }
            }
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        // if ($this->is_admin_changes) {

            // обработка данных о связях со специальностями
            $this->updateSpecRelations();
            
            // обработка данных о связях с клиниками
            $this->updateClinicRelations();
            
            // обработка данных о связях с услугами
            $this->updateServicesRelations();

            // обработка данных о связях со статьями
            $this->updateArticleRelations();
        
            $this->updateVideoList();

            $this->addNewVideo();
            
            // обработка данных о сортировке на страницах специальностей
            $this->updateSpecSort();
            
            // обработка данных о сортировке на страницах услуг
            $this->updateServicesSort();
            
            // обработка данных о сортировке на страницах клиник
            $this->updateClinicSort();

            // обработка данных о сортировке на страницах статей
            $this->updateArticleSort();
    
            if (empty($this->alias)) {
                $this->alias = Transliteration::getTransliteration($this->doctor_title);
                $this->save();
            }
    
            if (empty($this->doctor_hc_draft_id)) {
                $model = new HcDraft;
                $model->name = $this->doctor_title;
                $model->alias = $this->alias;
                $model->save();
                $this->doctor_hc_draft_id = $model->id;
                $this->save();
            }

        // }

        parent::afterSave($insert, $changedAttributes);
    }
}
