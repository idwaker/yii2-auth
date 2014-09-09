<?php

namespace idwaker\auth\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use idwaker\auth\models\Permission;

/**
 * PermissionSearch represents the model behind the search form about `idwaker\auth\models\Permission`.
 */
class PermissionSearch extends Permission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent', 'rule_id'], 'integer'],
            [['name', 'description', 'created_on', 'updated_on'], 'safe'],
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
        $query = Permission::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent' => $this->parent,
            'rule_id' => $this->rule_id,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
