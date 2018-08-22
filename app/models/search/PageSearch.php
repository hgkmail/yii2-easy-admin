<?php

namespace app\models\search;

use app\base\TreeArrayDataProvider;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Page;

/**
 * PageSearch represents the model behind the search form of `app\models\Page`.
 */
class PageSearch extends Page
{
    public $author;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'visibility', 'author_id', 'created_at', 'updated_at', 'parent_id', 'order'], 'integer'],
            [['title', 'content', 'cover', 'author'], 'safe'],
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
        $query = Page::find()->defaultOrder();
        $query = $query->from(['p' => '{{%page}}'])->joinWith(['author au']);

        // add conditions that should always apply here

        // display like a tree default
        $dataProvider = null;
        if(isset($params['sort']) || isset($params['PageSearch'])) {
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
            ]);
        } else {
            // filter top elements
            if (isset($params['top-filter'])) {
                $top = $params['top-filter'];
                $query->where("parent_id=0 and p.title like :top", [':top' => "%$top%"])
                    ->orWhere('parent_id!=0');
            }
            // array data provider
            $allModels = $query->all();
            $dataProvider = new TreeArrayDataProvider([
                'allModels' => $allModels,
                'pagination' => [
                    'pageSize' => 5,
                ]
            ]);
            $dataProvider->label_field = 'title';
        }

        $dataProvider->sort->attributes['author'] = [
            'asc' => ['au.username' => SORT_ASC],
            'desc' => ['au.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'p.status' => $this->status,
            'p.visibility' => $this->visibility,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'au.username', $this->author]);

        return $dataProvider;
    }
}
