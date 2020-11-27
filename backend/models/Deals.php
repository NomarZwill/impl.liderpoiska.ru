<?php

namespace backend\models;

use Yii;
use yii\helpers\FileHelper;
use \common\components\Transliteration;

/**
 * This is the model class for table "deals".
 *
 * @property int $deals_id
 * @property string $deals_title
 * @property string $deals_long_title
 * @property string $deals_description
 * @property string $deals_index_description
 * @property string $alias
 * @property string $deals_image_front
 * @property string $deals_image_back
 * @property string $deals_content
 * @property int $old_id
 */
class Deals extends \yii\db\ActiveRecord
{

    public $small_image;
    public $full_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deals_title', 'h1_title', 'deals_content'], 'required'],
            [['deals_title', 'deals_long_title', 'deals_description', 'deals_index_description', 'keywords', 'h1_title', 'breadcrumbs_title', 'alias', 'deals_image_front', 'deals_image_back', 'deals_content'], 'string'],
            [['deals_sort', 'old_id', 'is_active'], 'integer'],
            [['full_image', 'small_image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'deals_id' => 'ID',
            'deals_title' => 'Название',
            'deals_long_title' => 'Title',
            'deals_description' => 'Description',
            'deals_index_description' => 'Описание в карточке (главная и листинг)',
            'keywords' => 'Ключевые слова',
            'h1_title' => 'Заголовок h1',
            'breadcrumbs_title' => 'Название в хлебной крошке',
            'alias' => 'Alias',
            'is_active' => 'Активен',
            'deals_image_front' => 'Изображение для карточки (главная и листинг)',
            'deals_image_back' => 'Изображение для страницы',
            'deals_content' => 'Описание для страницы',
            'full_image' => 'Загруженное изображение для страницы',
            'small_image' => 'Загруженное изображение превью',
            'deals_sort' => 'Позиция на страницах',
            'old_id' => 'Old ID',
        ];
    }

    public function getSeo(){
        return $seo = [
            'title' => $this->deals_long_title,
            'desc' => $this->deals_description,
            'kw' => $this->keywords,
        ];
    }

    public function uploadImage()
    {
        if ($this->validate()) {
            if (!empty($this->small_image)) {

                foreach ($this->small_image as $file) {
                    $path = 'images/uploaded/deals/'. $this->deals_id . '/';
                    FileHelper::createDirectory($path);
                    $file->saveAs($path . time() . '_small.' . $file->extension);
                    $this->deals_image_front = time() . '_small.' . $file->extension;
                }
            }
            if (!empty($this->full_image)) {
                
                foreach ($this->full_image as $file) {
                    $path = 'images/uploaded/deals/'. $this->deals_id . '/';
                    FileHelper::createDirectory($path);
                    $file->saveAs($path . time() . '.' . $file->extension);
                    $this->deals_image_back = time() . '.' . $file->extension;
                }
            }
            return true;
        } else {
            return $this->validate();
        }
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
