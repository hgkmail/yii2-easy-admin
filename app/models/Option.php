<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%option}}".
 *
 * @property int $id
 * @property string $type
 * @property int $user_id
 * @property string $key
 * @property string $value
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Option extends ActiveRecord
{
    const TYPE_GLOBAL = 'global';           // global options without user id
    const TYPE_GRID_COLS = 'grid_cols';     // GridView columns visibility
    const TYPE_GRID_PAGE = 'grid_page';     // GridView page size
    const TYPE_THEME_SKIN = 'theme_skin';   // Theme skin

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%option}}';
    }

    public function behaviors()
    {
        return [
          TimestampBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'string'],
            [['type', 'key'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', 'Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('options');
    }

    /**
     * {@inheritdoc}
     * @return OptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OptionQuery(get_called_class());
    }

}
