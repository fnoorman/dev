<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Video;

/**
 * VideoSearch represents the model behind the search form about `common\models\Video`.
 */
class VideoSearch extends Video
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'size', 'duration', 'created_at', 'updated_at', 'created_by', 'updated_by', 'confirmed'], 'integer'],
            [['title','embed','poster','description', 'videoId', 'mobileLink', 'sdLink', 'hlsLink'], 'safe'],
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
        $query = Video::find();

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
            'size' => $this->size,
            'duration' => $this->duration,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'confirmed' => $this->confirmed,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'embed', $this->embed])
            ->andFilterWhere(['like', 'poster', $this->poster])
            ->andFilterWhere(['like', 'videoId', $this->videoId])
            ->andFilterWhere(['like', 'mobileLink', $this->mobileLink])
            ->andFilterWhere(['like', 'sdLink', $this->sdLink])
            ->andFilterWhere(['like', 'hlsLink', $this->hlsLink]);

        return $dataProvider;
    }
}
