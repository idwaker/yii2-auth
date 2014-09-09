<?php

namespace idwaker\auth\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use idwaker\auth\models\Rule;

/**
 * RuleSearch represents the model behind the search form about `idwaker\auth\models\Rule`.
 */
class RuleSearch extends Rule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'data', 'created_on', 'updated_on'], 'safe'],
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
        $query = Rule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
