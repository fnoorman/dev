<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Topup;

/**
 * TopupSearch represents the model behind the search form about `common\models\Topup`.
 */
class TopupSearch extends Topup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'maxCallOut', 'updated_at', 'created_at', 'update_by', 'created_by', 'position', 'enable', 'limitBy', 'quota'], 'integer'],
            [['name'], 'safe'],
            [['unitPrice', 'price'], 'number'],
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
        $query = Topup::find();

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
            'unitPrice' => $this->unitPrice,
            'maxCallOut' => $this->maxCallOut,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'update_by' => $this->update_by,
            'created_by' => $this->created_by,
            'position' => $this->position,
            'enable' => $this->enable,
            'price' => $this->price,
            'limitBy' => $this->limitBy,
            'quota' => $this->quota,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
