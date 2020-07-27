<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property int $partner_id
 * @property string $partner_name
 * @property string $partner_logo
 * @property string $partner_url
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_name', 'partner_logo', 'partner_url'], 'required'],
            [['partner_logo', 'partner_url'], 'string'],
            [['partner_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'partner_id' => 'Partner ID',
            'partner_name' => 'Partner Name',
            'partner_logo' => 'Partner Logo',
            'partner_url' => 'Partner Url',
        ];
    }
}
