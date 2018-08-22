<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comment;

/**
 * CommentSearch represents the model behind the search form of `app\models\Comment`.
 */
class CommentSearch extends Comment
{
    public $post;
    public $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'post', 'user'], 'safe'],
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
        $query = Comment::find();
        $query->from(['c' => '{{%comment}}'])
            ->joinWith(['user u'])->joinWith(['post p']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $dataProvider->sort->attributes['post'] = [
            'asc' => ['p.title' => SORT_ASC],
            'desc' => ['p.title' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['u.username' => SORT_ASC],
            'desc' => ['u.username' => SORT_DESC],
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
            'c.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'c.title', $this->title])
            ->andFilterWhere(['like', 'p.title', $this->post])
            ->andFilterWhere(['like', 'u.username', $this->user]);

        return $dataProvider;
    }
}
