<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "doctors_page_galleries".
 *
 * @property int $id
 * @property int $doctor_id
 * @property string $block_type
 * @property string $filepath
 */
class DoctorsPageGalleries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctors_page_galleries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'block_type', 'filepath'], 'required'],
            [['doctor_id'], 'integer'],
            [['block_type', 'filepath'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_id' => 'Doctor ID',
            'block_type' => 'Block Type',
            'filepath' => 'Filepath',
        ];
    }

    public function getDoctorsVideoForSelect2($doctor_id){
        $currentLinkList = [];
        foreach (DoctorsPageGalleries::find()->where(['doctor_id' => $doctor_id, 'block_type' => 'video'])->all() as $video) {
            $currentLinkList[$video->id] = $video->filepath;
        }
        return $currentLinkList;
    }
}
