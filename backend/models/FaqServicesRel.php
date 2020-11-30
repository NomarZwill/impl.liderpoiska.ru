<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "faq_services_rel".
 *
 * @property int $id
 * @property int $faq_id
 * @property int $service_id
 */
class FaqServicesRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq_services_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['faq_id', 'service_id'], 'required'],
            [['faq_id', 'service_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faq_id' => 'Faq ID',
            'service_id' => 'Service ID',
        ];
    }

    public function getFaqServiceIDs($faqID){
        $faqServiceIDList = [];
        $faqServiceList = FaqServicesRel::find()->where(['faq_id' => $faqID])->all();

        foreach ($faqServiceList as $item) {
            $faqServiceIDList[] = $item->service_id;
        }
        return $faqServiceIDList;
    }

    public function getFaq() {
        return $this->hasMany(Faq::className(), ['faq_id' => 'faq_id'])
            ->joinWith('doctor');
    }
}
