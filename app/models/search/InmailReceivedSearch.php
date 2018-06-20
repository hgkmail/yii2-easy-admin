<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InmailReceived;

/**
 * InmailReceivedSearch represents the model behind the search form of `app\models\InmailReceived`.
 */
class InmailReceivedSearch extends InmailReceived
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sent_id', 'created_at', 'read_at'], 'integer'],
            [['sender', 'receivers', 'receiver', 'subject', 'content'], 'safe'],
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
        $query = InmailReceived::find();

        // add conditions that should always apply here
        if(!Yii::$app->user->getIsGuest()) {
            $query->andWhere(['receiver' => Yii::$app->user->getIdentity()->username]);
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
            'sent_id' => $this->sent_id,
            'created_at' => $this->created_at,
            'read_at' => $this->read_at,
        ]);

        $query->andFilterWhere(['like', 'sender', $this->sender])
            ->andFilterWhere(['like', 'receivers', $this->receivers])
            ->andFilterWhere(['like', 'receiver', $this->receiver])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
