<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inmail;

/**
 * InmailSearch represents the model behind the search form of `app\models\Inmail`.
 */
class InmailSearch extends Inmail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at'], 'integer'],
            [['sender', 'receivers', 'content'], 'string'],
            ['subject', 'string'],
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
        $query = Inmail::find();

        // add conditions that should always apply here
        if(!Yii::$app->user->getIsGuest()) {
            $query->andWhere(['sender' => Yii::$app->user->getIdentity()->username]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
              ->andFilterWhere(['like', 'subject', $this->subject])
              ->andFilterWhere(['like', 'sender', $this->sender])
              ->andFilterWhere(['like', 'receivers', $this->receivers]);

        return $dataProvider;
    }
}
