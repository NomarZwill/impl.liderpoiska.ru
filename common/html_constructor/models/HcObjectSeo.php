<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\html_constructor\models;


use Yii;

/**
 * This is the base-model class for table "hc_object_seo".
 *
 * @property integer $id
 * @property integer $hc_object_id
 * @property integer $active
 * @property string $heading
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text1
 * @property string $text2
 * @property string $text3
 * @property string $pagination_heading
 * @property string $pagination_title
 * @property string $pagination_description
 * @property string $pagination_keywords
 * @property string $img_alt
 *
 * @property \common\html_constructor\models\HcObject $hcObject
 * @property string $aliasModel
 */
class HcObjectSeo extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hc_object_seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hc_object_id', 'active'], 'integer'],
            [['title', 'description', 'text1', 'text2', 'text3', 'pagination_title', 'pagination_description'], 'string'],
            [['heading', 'keywords', 'pagination_heading', 'pagination_keywords'], 'string', 'max' => 255],
            [['hc_object_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\html_constructor\models\HcObject::class, 'targetAttribute' => ['hc_object_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'hc_object_id' => Yii::t('models', 'Site Object ID'),
            'active' => 'Активен',
            'heading' => Yii::t('models', 'Heading'),
            'title' => Yii::t('models', 'Title'),
            'description' => Yii::t('models', 'Description'),
            'keywords' => Yii::t('models', 'Keywords'),
            'text1' => Yii::t('models', 'Text1'),
            'text2' => Yii::t('models', 'Text2'),
            'text3' => 'Text 3',
            'pagination_heading' => 'Пагинация - h1',
            'pagination_title' => 'Пагинация - title',
            'pagination_description' => 'Пагинация - description',
            'pagination_keywords' => 'Пагинация - kw',
            'img_alt' => 'Альт',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHcObject()
    {
        return $this->hasOne(\common\html_constructor\models\HcObject::class, ['id' => 'hc_object_id']);
    }
}
