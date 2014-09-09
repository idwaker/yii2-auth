<?php

namespace idwaker\auth\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use idwaker\auth\models\User;

/**
 * UserSearch represents the model behind the search form about `idwaker\auth\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'is_loggedin'], 'integer'],
            [['username', 'auth_key', 'password', 'last_loggedin', 'created_on', 'updated_on'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'is_loggedin' => $this->is_loggedin,
            'last_loggedin' => $this->last_loggedin,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
