<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property int $id
 * @property string $label
 * @property string $icon
 * @property string $url
 * @property int $order
 * @property int $parent_id
 * @property int $created_at
 * @property int $updated_at
 *
 */
class Menu extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label'], 'required'],
            [['order', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['label', 'icon'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 1000],
            [['order', 'parent_id'], 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'label' => Yii::t('app', 'Label'),
            'icon' => Yii::t('app', 'Icon'),
            'url' => Yii::t('app', 'Url'),
            'order' => Yii::t('app', 'Order'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
}
