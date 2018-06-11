<?php

namespace app\models\search;

use app\base\MenuGridWalker;
use app\base\TreeArrayDataProvider;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Menu;
use yii\data\ArrayDataProvider;

/**
 * MenuSearch represents the model behind the search form of `app\models\Menu`.
 */
class MenuSearch extends Menu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order', 'parent_id'], 'integer'],
            [['label', 'icon', 'url'], 'safe'],
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
        $query = Menu::find();

        // add conditions that should always apply here

        $dataProvider = null;
        if(isset($params['sort']) || isset($params['MenuSearch'])) {
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
                $query->where('parent_id!=0')
                    ->orWhere("parent_id=0 and label like :top", [':top' => "%$top%"]);
            }
            // array data provider
            $allModels = $query->all();
            $dataProvider = new TreeArrayDataProvider([
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
            'order' => $this->order,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
