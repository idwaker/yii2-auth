<?php

namespace idwaker\auth\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use idwaker\auth\models\Role;

/**
 * RoleSearch represents the model behind the search form about `idwaker\auth\models\Role`.
 */
class RoleSearch extends Role
{
    public $parent;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent'], 'integer'],
            [['name', 'description', 'created_on', 'parent'], 'safe'],
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
        $query = Role::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent' => $this->parent,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
