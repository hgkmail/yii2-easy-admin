<?php

namespace app\models\search;

use app\base\TreeArrayDataProvider;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * CategorySearch represents the model behind the search form of `app\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'desc'], 'safe'],
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
        $query = Category::find();

        // display like a tree default
        $dataProvider = null;
        if(isset($params['sort']) || isset($params['CategorySearch'])) {
            // active data provider
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 20,
                ],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            ]);
        } else {
            // filter top elements
            if (isset($params['top-filter'])) {
                $top = $params['top-filter'];
                $query->Where("parent_id=0 and name like :top", [':top' => "%$top%"])
                      ->orWhere('parent_id!=0');
            }
            // array data provider
            $allModels = $query->all();
            $dataProvider = new TreeArrayDataProvider([
                'label_field' => 'name',
                'allModels' => $allModels,
                'pagination' => [
                    'pageSize' => 5,
                ]
            ]);
        }

        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
