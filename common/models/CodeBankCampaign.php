<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\User;
use common\models\Review;
/**
 * This is the model class for table "{{%codeBank_campaign}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $codeBank_code
 * @property string $name
 * @property string $modelClass
 * @property integer $objectId
 * @property integer $startDate
 * @property integer $endDate
 * @property integer $active
 *
 * @property CampaignTag[] $campaignTags
 * @property Tag[] $tags
 * @property CodeBank $codeBankCode
 */
class CodeBankCampaign extends \yii\db\ActiveRecord
{

//    private $_date_from;
//    private $_date_to;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            OwnerBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%codeBank_campaign}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'objectId','startDate','endDate', 'active'], 'integer'],
            [['codeBank_code','modelClass','objectId','name'], 'required', 'on'=>'step4'],
            [['codeBank_code','modelClass','name'], 'required', 'on'=>'step1'],
            [['codeBank_code'], 'string', 'max' => 19],
            [['name'], 'string', 'max' => 255],
            [['startDate','endDate'], 'default', 'value' => null],
            [['dateFrom'], 'date'],
            [['dateTo'], 'date'],
            [['modelClass'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'codeBank_code' => Yii::t('app', 'Hybrizy Code'),
            'name' => Yii::t('app', 'Name'),
            'modelClass' => Yii::t('app', 'Campaign Type'),
            'objectId' => Yii::t('app', 'Object ID'),
            'startDate' => Yii::t('app', 'Start Date'),
            'endDate' => Yii::t('app', 'End Date'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    public function validateStartDate($attribute, $params)
    {
        $this->startDate = idate('U',strtotime($this->dateFrom));
    }

    public function validateEndDate($attribute, $params)
    {
        $this->endDate =idate('U', strtotime($this->dateTo));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaignTags()
    {
        return $this->hasMany(CampaignTag::className(), ['codeBank_campaign_id' => 'id']);
    }

    public function getVideo()
    {
        $video = Yii::$app->params['coreModel']. $this->modelClass;
        return $video::find()->where(['id'=>$this->objectId])->one();
    }

    public function getReview()
    {
        return $this->hasOne(Review::className(),['id'=>'objectId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%campaign_tag}}', ['codeBank_campaign_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodeBankCode()
    {
        return $this->hasOne(CodeBank::className(), ['code' => 'codeBank_code']);
    }

    /**
     * @inheritdoc
     * @return CodeBankCampaignQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodeBankCampaignQuery(get_called_class());
    }

    public function setDateFrom($value)
    {
        $this->startDate = idate('U',strtotime($value));
//        $this->_date_from = $value;
    }

    public function getDateFrom()
    {
        if(isset($this->startDate))
            return Yii::$app->formatter->asDate($this->startDate);
        else
            return null;
    }

    public function setDateTo($value)
    {
        $this->endDate =idate('U', strtotime($value));
//        $this->_date_to = $value;
    }

    public function getDateTo()
    {
        if(isset($this->endDate))
            return Yii::$app->formatter->asDate($this->endDate);
        else
            return null;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'created_by']);
    }
}
