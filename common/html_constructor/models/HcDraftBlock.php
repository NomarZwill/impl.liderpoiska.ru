<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\html_constructor\models;


use common\html_constructor\models\BaseHcObject;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the base-model class for table "hc_draft_block".
 *
 * @property integer $id
 * @property integer $hc_draft_id
 * @property integer $hc_block_id
 * @property string $content
 * @property integer $sort
 *
 * @property \common\html_constructor\models\HcBlock $hcBlock
 * @property \common\html_constructor\models\HcDraft $hcDraft
 * @property string $aliasModel
 */
class HcDraftBlock extends BaseHcObject
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hc_draft_block';
    }

    public function extraFields()
    {
        return ['hcBlock', 'fileTargets'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hc_draft_id', 'hc_block_id', 'sort'], 'integer'],
            [['content'], 'string'],
            [['hc_block_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\html_constructor\models\HcBlock::class, 'targetAttribute' => ['hc_block_id' => 'id']],
            [['hc_draft_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\html_constructor\models\HcDraft::class, 'targetAttribute' => ['hc_draft_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'hc_draft_id' => Yii::t('models', 'Hc Draft ID'),
            'hc_block_id' => Yii::t('models', 'Hc Block ID'),
            'content' => Yii::t('models', 'Content'),
            'sort' => Yii::t('models', 'Sort'),
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $last = self::find()
                ->where(['hc_draft_id' => $this->hc_draft_id])
                ->orderBy(['sort' => SORT_DESC])
                ->one();
            $newSort = empty($last) ? 1 : $last->sort + 1;
            $this->sort = $newSort;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHcBlock()
    {
        return $this->hasOne(\common\html_constructor\models\HcBlock::class, ['id' => 'hc_block_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHcDraft()
    {
        return $this->hasOne(\common\html_constructor\models\HcDraft::class, ['id' => 'hc_draft_id']);
    }

    public function getHtml($extraData = [])
    {
        return $this->hcBlock->render($this, $extraData);
    }

    public function getParagraph()
    {
        try {
            $dataFromInputs = Json::decode($this->content);
        } catch (\Throwable $th) {
            return null;
        }
        return $dataFromInputs['paragraph'] ?? null;
    }

}
