<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%answer}}".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $answer
 * @property integer $correctObjective
 * @property string $correctSubjective
 *
 * @property Question $question
 * @property QuestionParticipant[] $questionParticipants
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%answer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer'], 'required','on'=>'objective'],
            [['correctSubjective'], 'required','on'=>'subjective'],
            [['question_id', 'correctObjective'], 'integer'],
            [['answer', 'correctSubjective'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'answer' => Yii::t('app', 'Answer'),
            'correctObjective' => Yii::t('app', 'Correct Objective'),
            'correctSubjective' => Yii::t('app', 'Correct Subjective'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionParticipants()
    {
        return $this->hasMany(QuestionParticipant::className(), ['answer_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AnswerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AnswerQuery(get_called_class());
    }
}
