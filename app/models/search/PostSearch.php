<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\models\Post`.
 */
class PostSearch extends Post
{
    public $author;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'commentStatus', 'status', 'visibility', 'author_id', 'created_at', 'updated_at'], 'integer'],
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
        $query = Post::find();
        $query->joinWith(['author au']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

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
            'commentStatus' => $this->commentStatus,
            'status' => $this->status,
            'visibility' => $this->visibility,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'au.username', $this->author])
            ->andFilterWhere(['like', 'cover', $this->cover]);

        return $dataProvider;
    }
}
