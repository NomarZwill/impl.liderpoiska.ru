<?php

namespace backend\models;
use yii\helpers\FileHelper;

use Yii;

/**
 * This is the model class for table "partners_deals".
 *
 * @property int $id
 * @property string $partner_image
 * @property string $deal_text
 */
class PartnersDeals extends \yii\db\ActiveRecord
{
    public $full_image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners_deals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['partner_image', 'deal_text'], 'required'],
            [['partner_name', 'partner_image', 'deal_text'], 'string'],
            [['is_active',], 'integer'],
            [['full_image',], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_name' => 'Название',
            'partner_image' => 'Логотип',
            'deal_text' => 'Описание',
            'full_image' => 'Загруженное изображение',
            'is_active' => 'Активен',
        ];
    }

    public function uploadImage()
    {
        //if ($this->validate()) {
        foreach ($this->full_image as $file) {
            $path = 'images/uploaded/partnersDeals/'. $this->id . '/';
            FileHelper::createDirectory($path);
            $file->saveAs($path . time() . '.' . $file->extension);
            $this->partner_image = time() . '.' . $file->extension;
        }
        return true;
        //} else {
        //    return false;
        //}
    }
}
