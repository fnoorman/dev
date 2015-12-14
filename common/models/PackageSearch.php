<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Package;

/**
 * PackageSearch represents the model behind the search form about `common\models\Package`.
 */
class PackageSearch extends Package
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','mask', 'maxCallOut', 'maxAllowedCode', 'enable', 'minBalance', 'updated_by', 'updated_at', 'created_by', 'created_at', 'duration', 'expiredBy', 'position', 'limitBy', 'quota'], 'integer'],
            [['name', 'code', 'videoMaxSize', 'pictureMaxSize'], 'safe'],
            [['price'], 'number'],
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
        $query = Package::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' =>10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'maxCallOut' => $this->maxCallOut,
            'maxAllowedCode' => $this->maxAllowedCode,
            'enable' => $this->enable,
            'minBalance' => $this->minBalance,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'duration' => $this->duration,
            'expiredBy' => $this->expiredBy,
            'price' => $this->price,
            'position' => $this->position,
            'limitBy' => $this->limitBy,
            'quota' => $this->quota,
            'mask' => $this->mask,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'videoMaxSize', $this->videoMaxSize])
            ->andFilterWhere(['like', 'pictureMaxSize', $this->pictureMaxSize]);

        return $dataProvider;
    }
}
