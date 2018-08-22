<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%open_auth}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $source
 * @property string $source_id
 *
 * @property User $user
 */
class OpenAuth extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%open_auth}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['source'], 'string', 'max' => 30],
            [['source_id'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'source' => Yii::t('app', 'Source'),
            'source_id' => Yii::t('app', 'Source ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('openAuths');
    }

    /**
     * {@inheritdoc}
     * @return OpenAuthQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpenAuthQuery(get_called_class());
    }
}
