<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%nav_menu_item}}".
 *
 * @property int $pk_id
 * @property int $id
 * @property string $label
 * @property string $icon
 * @property string $action
 * @property string $target
 * @property string $extra
 * @property int $menu_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NavMenu $menu
 */
class NavMenuItem extends ActiveRecord
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nav_menu_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['label', 'icon', 'action', 'target', 'extra'], 'string', 'max' => 255],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => NavMenu::class, 'targetAttribute' => ['menu_id' => 'id']],
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
            'label' => Yii::t('app', 'Label'),
            'icon' => Yii::t('app', 'Icon'),
            'action' => Yii::t('app', 'Action'),
            'target' => Yii::t('app', 'Target'),
            'extra' => Yii::t('app', 'Extra'),
            'menu_id' => Yii::t('app', 'Menu ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(NavMenu::class, ['id' => 'menu_id'])->inverseOf('navMenuItems');
    }

    /**
     * {@inheritdoc}
     * @return NavMenuItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NavMenuItemQuery(get_called_class());
    }

    public function formName()
    {
        return '';
    }
}
