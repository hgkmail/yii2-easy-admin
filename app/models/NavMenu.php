<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%nav_menu}}".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $location
 * @property int $status
 * @property array $item_tree
 * @property int $created_at
 * @property int $updated_at
 */
class NavMenu extends ActiveRecord
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nav_menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['item_tree'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['location'], 'string', 'max' => 20],
            [['name', 'location'], 'required'],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'desc' => Yii::t('app', 'Desc'),
            'location' => Yii::t('app', 'Location'),
            'status' => Yii::t('app', 'Status'),
            'item_tree' => Yii::t('app', 'Item Tree'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return NavMenuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NavMenuQuery(get_called_class());
    }

    /**
     * @return ActiveQuery
     */
    public function getNavMenuItems()
    {
        return $this->hasMany(NavMenuItem::class, ['menu_id' => 'id'])->inverseOf('menu');
    }
}
