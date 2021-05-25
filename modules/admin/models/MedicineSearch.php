<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Medicine;

/**
 * MedicineSearch represents the model behind the search form of `app\modules\admin\models\Medicine`.
 */
class MedicineSearch extends Medicine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price', 'in_stock', 'critical_norm', 'category_id', 'type_id', 'counter'], 'integer'],
            [['name', 'prod_tech'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Medicine::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'in_stock' => $this->in_stock,
            'critical_norm' => $this->critical_norm,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'counter' => $this->counter,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'prod_tech', $this->prod_tech]);

        return $dataProvider;
    }
}