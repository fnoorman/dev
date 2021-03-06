<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CodeBankCampaign;

/**
 * CodeBankCampaignSearch represents the model behind the search form about `common\models\CodeBankCampaign`.
 */
class CodeBankCampaignSearch extends CodeBankCampaign
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'objectId', 'startDate', 'endDate', 'active'], 'integer'],
            [['codeBank_code', 'name', 'modelClass'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CodeBankCampaign::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'objectId' => $this->objectId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'active' => $this->active,
            'codeBank_code' => $this->codeBank_code,
        ]);

//        $query->andFilterWhere(['like', 'codeBank_code', $this->codeBank_code])
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'modelClass', $this->modelClass]);

        return $dataProvider;
    }
}
