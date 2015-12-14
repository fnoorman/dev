<?php

namespace common\models;

use common\components\behaviors\OwnerBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%question}}".
 *
 * @property integer $id
 * @property integer $campaign_id
 * @property string $question
 * @property integer $qType
 * @property integer $required
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property Answer[] $answers
 * @property QuestionParticipant[] $questionParticipants
 */
class Question extends \yii\db\ActiveRecord
{

    public $options = ['Subjective','Objective'];

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            OwnerBehavior::className()
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%question}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'qType','question'], 'required'],
            [['campaign_id', 'qType', 'required', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['question'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'campaign_id' => Yii::t('app', 'Campaign ID'),
            'question' => Yii::t('app', 'Question'),
            'qType' => Yii::t('app', 'Question Type'),
            'required' => Yii::t('app', 'Check if user is required to answer this question'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionParticipants()
    {
        return $this->hasMany(QuestionParticipant::className(), ['question_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return QuestionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionQuery(get_called_class());
    }
}
