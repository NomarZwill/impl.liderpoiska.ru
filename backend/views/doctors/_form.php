<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use backend\models\Doctors;
use backend\models\DoctorsPageSort;
use backend\models\DoctorsPageGalleries;
use backend\models\MedicalSpecialties;
use backend\models\DoctorsMedSpec;
use backend\models\Clinics;
use backend\models\DoctorsAndClinics;
use backend\models\Servises;
use backend\models\DoctorsServicesRel;
use backend\models\Articles;
use backend\models\ArticlesDoctorsRel;
use kartik\select2\Select2;
use kartik\file\FileInput;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Doctors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doctors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_title')->textInput() ?>

    <?= $form->field($model, 'doctor_long_title')->textInput() ?>

    <?= $form->field($model, 'doctor_description')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'breadcrumbs_title')->textInput() ?>
    
    <?php if (empty($isCreate)){ ?>
        
        <?= $form->field($model, 'alias')->textInput() ?>
        
    <?php } ?>

    <?= $form->field($model, 'is_active')->checkbox() ?>

    <?php if (empty($isCreate)){ ?>

        <?php
            $initialPreview = [];
            $initialPreviewConfig = [];
            $path = 'images/uploaded/doctors/'. $model->doctor_id . '/';
            if (is_dir($path)) {
                $images =  FileHelper::findFiles($path);

                if (!empty($model->doctor_image)) {
                    $initialPreview[] = Html::img(Url::to('@web/' . $path .  $model->doctor_image), ['class'=>'file-preview-image']);
                }

                $initialPreviewConfig[] = ['caption' => '', 'width' => "120px", 'url' => "/doctors/" . $model->doctor_id . "/delete-image/", 'key' => ''];
            }
        ?>

        <?=  $form->field($model, 'doctor_image_load')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileCount' => 1,
            ]
        ])?>

    
        <?= $form->field($model, 'doctor_listing_sort')->textInput() ?>

        <?php
            $allSpecialtiesData = MedicalSpecialties::getArrayToSelect2();
            $activeDoctorSpec = DoctorsMedSpec::getDoctorSpecialtyIDs($model->doctor_id);
        ?>

        <?= $form->field($model, 'doctor_spec_rel')->widget(Select2::classname(), [
            'data' => $allSpecialtiesData,
            //'maintainOrder' => true,
            'options' => ['value' => $activeDoctorSpec, 'placeholder' => 'Выберите специальности', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

        <?php
            $specSortOptions = [];
            foreach ($activeDoctorSpec as $specID) {
                $spec = MedicalSpecialties::find()->where(['specialty_id' => $specID])->one();

                $currentSortValue = 0;
                if (DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'medSpeciality', 'page_id' => $specID])->exists()) {
                    $currentSortValue = DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'medSpeciality', 'page_id' => $specID])->one()->sort_index;
                }

                $specSortOptions[] = [
                    'name'  => $spec->specialty_id, 
                    'title' => $spec->specialty_title, 
                    'defaultValue' => $currentSortValue,
                ];
            }
        ?>

        <?= $form->field($model,'doctor_spec_sort')->widget(MultipleInput::className(), [
                'max' => 1,
                'columns' => $specSortOptions,
        ]);?>

        <?php
            $allServicesData = Servises::getArrayToSelect2();
            $activeDoctorServices = DoctorsServicesRel::getDoctorServiceIDs($model->doctor_id);
        ?>

        <?= $form->field($model, 'doctor_service_rel')->widget(Select2::classname(), [
            'data' => $allServicesData,
            //'maintainOrder' => true,
            'options' => ['value' => $activeDoctorServices, 'placeholder' => 'Выберите услуги', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

        <?php
            $serviceSortOptions = [];
            foreach ($activeDoctorServices as $serviceID) {
                $service = Servises::find()->where(['servise_id' => $serviceID])->one();

                $currentSortValue = 0;
                if (DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'services', 'page_id' => $serviceID])->exists()) {
                    $currentSortValue = DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'services', 'page_id' => $serviceID])->one()->sort_index;
                }

                $serviceSortOptions[] = [
                    'name'  => $service->servise_id, 
                    'title' => $service->header_menu_title, 
                    'defaultValue' => $currentSortValue,
                ];
            }
        ?>

        <?= $form->field($model,'doctor_service_sort')->widget(MultipleInput::className(), [
                'max' => 1,
                'columns' => $serviceSortOptions,
        ]);?>

        <?php
            $allClinicsData = Clinics::getArrayToSelect2();
            $activeDoctorClinics = DoctorsAndClinics::getDoctorClinicIDs($model->doctor_id);
        ?>
        
        <?= $form->field($model, 'doctor_clinic_rel')->widget(Select2::classname(), [
            'data' => $allClinicsData,
            //'maintainOrder' => true,
            'options' => ['value' => $activeDoctorClinics, 'placeholder' => 'Выберите клиники', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

        <?php
            $clinicSortOptions = [];
            foreach ($activeDoctorClinics as $clinicID) {
                $clinic = Clinics::find()->where(['clinic_id' => $clinicID])->one();

                $currentSortValue = 0;
                if (DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'clinics', 'page_id' => $clinicID])->exists()) {
                    $currentSortValue = DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'clinics', 'page_id' => $clinicID])->one()->sort_index;
                }

                $clinicSortOptions[] = [
                    'name'  => $clinic->clinic_id, 
                    'title' => $clinic->card_title, 
                    'defaultValue' => $currentSortValue,
                ];
            }
        ?>

        <?= $form->field($model,'doctor_clinic_sort')->widget(MultipleInput::className(), [
                'max' => 1,
                'columns' => $clinicSortOptions,
        ]);?>

        <?php
            $allArticlesData = Articles::getArrayToSelect2();
            $activeDoctorArticles = ArticlesDoctorsRel::getDoctorArticleIDs($model->doctor_id);
        ?>

        <?= $form->field($model, 'article_doctor_rel')->widget(Select2::classname(), [
            'data' => $allArticlesData,
            'options' => ['value' => $activeDoctorArticles, 'placeholder' => 'Выберите статьи', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

        <?php
            $articlesSortOptions = [];
            foreach ($activeDoctorArticles as $articleID) {
                $article = Articles::find()->where(['id' => $articleID])->one();

                $currentSortValue = 0;
                if (DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'articles', 'page_id' => $articleID])->exists()) {
                    $currentSortValue = DoctorsPageSort::find()->where(['doctor_id' => $model->doctor_id, 'page_type' => 'articles', 'page_id' => $articleID])->one()->sort_index;
                }

                $articlesSortOptions[] = [
                    'name'  => $article->id, 
                    'title' => $article->h1_title, 
                    'defaultValue' => $currentSortValue,
                ];
            }
        ?>

        <?= $form->field($model,'article_doctor_sort')->widget(MultipleInput::className(), [
                'max' => 1,
                'columns' => $articlesSortOptions,
        ]);?>

        <?php
            $allVideosData = DoctorsPageGalleries::getDoctorsVideoForSelect2($model->doctor_id);
        ?>

        <?= $form->field($model, 'doctor_video_links')->widget(Select2::classname(), [
            'data' => $allVideosData,
            //'maintainOrder' => true,
            'options' => ['value' => array_keys($allVideosData), 'placeholder' => 'Список пуст', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);?>

        <?= $form->field($model,'doctor_new_video_links')->widget(MultipleInput::className(), [
                'max' => 5,
        ]);?>

        <?php
            $initialPreviewLizcenz = [];
            $initialPreviewConfigLizcenz = [];
            $path = 'images/uploaded/doctors/'. $model->doctor_id . '/lizcenz/';
            if (is_dir($path)) {
                $images = DoctorsPageGalleries::find()->where(['block_type' => 'lizcenz', 'doctor_id' => $model->doctor_id])->all();
                foreach ($images as $image) {
                    $initialPreviewLizcenz[] = Html::img(Url::to("@web/$path/$image->filepath"), ['class'=>'file-preview-image']);
                    $initialPreviewConfigLizcenz[] = ['caption' => '', 'width' => "120px", 'url' => "/doctors/" . $model->doctor_id . "/delete-gallery-lizcenz-image/" . $image->id . '/', 'key' => ''];
                }
            }
        ?>

        <?=  $form->field($model, 'doctor_lizcenz_gallery[]')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'initialPreview'=>$initialPreviewLizcenz,
                'initialPreviewConfig' => $initialPreviewConfigLizcenz,
                'overwriteInitial'=>false,
            ]
        ])?>

        <div class="form_draft_link_wrapper">
            <a class="form_draft_link" href="/hc-draft/<?= $model->doctor_hc_draft_id ?>/update/">Редактировать галереи работ</a>
        </div>

    <?php } ?>

    <?= $form->field($model, 'doctor_education')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'doctor_experience')->textInput() ?>

    <?= $form->field($model, 'answers_the_questions')->checkbox() ?>

    <?= $form->field($model, 'visible_on_home_page')->checkbox() ?>

    <!-- <?= $form->field($model, 'introtext')->textInput() ?> -->

    <!-- <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?> -->

    <!-- <?= $form->field($model, 'medic_to_filial')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_lab_smail')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_doyche_velle')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_esteticheskaya_stomatologiya_chistie_prudi')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_esteticheskaya_stomatologiya')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_impl')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_centr_implantologii')->textInput() ?> -->

    <!-- <?= $form->field($model, 'review_to_specials')->textInput() ?> -->

    <!-- <?= $form->field($model, 'specials_to_medic')->textInput() ?> -->

    <!-- <?= $form->field($model, 'review_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'query_to_service')->textInput() ?> -->

    <!-- <?= $form->field($model, 'faq_title')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_klinika_dentalgeneva')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_1005')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_1154')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_1459')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_988')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_989')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_990')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_991')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_992')->textInput() ?> -->

    <!-- <?= $form->field($model, 'sort_prec_994')->textInput() ?> -->

    <!-- <?= $form->field($model, 'old_id')->textInput() ?> -->



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
