<?php

namespace backend\models;

use Yii;
use \common\html_constructor\models\HcDraft;
use \common\components\Transliteration;


/**
 * This is the model class for table "our_works".
 *
 * @property int $id
 * @property string $alias
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1
 * @property int $service_id
 * @property string $service_name
 * @property int $draft_id
 */
class OurWorks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'our_works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['h1', 'service_id'], 'required'],
            [['alias', 'title', 'description', 'keywords', 'h1', 'service_name'], 'string'],
            [['service_id', 'draft_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'h1' => 'H1',
            'service_id' => 'Связанная услуга',
            'draft_id' => 'Draft ID',
        ];
    }

    public function getSeo(){
        return $seo = [
            'title' => $this->title,
            'desc' => $this->description,
            'kw' => $this->keywords,
        ];
    }

    public function getServiceName(){
        return Servises::find()
            ->where(['servise_id' => $this->service_id])
            ->one()
            ->header_menu_title;
    }

    public function setServiceName(){
        if ($this->getServiceName() !== $this->service_name) {
            $this->service_name =  $this->getServiceName();
            $this->save();
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setServiceName();
    
        if (empty($this->alias)) {
            $this->alias = Transliteration::getTransliteration($this->service_name);
            $this->save();
        }

        if (empty($this->draft_id)) {
            $model = new HcDraft;
            $model->name = $this->h1;
            $model->alias = $this->alias;
            $model->save();
            $this->draft_id = $model->id;
            $this->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }

}
