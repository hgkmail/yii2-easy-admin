<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\rbac\Item;

/**
 * This is the model class for table "{{%auth_item}}".
 * Only to display role, use DbManager to manage role.
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property int $created_at
 * @property int $updated_at
 */
class Role extends ActiveRecord
{
    const TYPE_ROLE = Item::TYPE_ROLE;
    const TYPE_PERMISSION = Item::TYPE_PERMISSION;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [['name'], 'unique'],
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
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new RoleQuery(get_called_class());
        $query->where(['type' => Item::TYPE_ROLE]);   // use andWhere outside
        return $query;
    }

    /**
     * @return ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::class, ['id' => 'menu_id'])
            ->viaTable('{{%role_menu}}', ['role_name' => 'name']);
    }

    /**
     * @param array $menuIds
     * @throws \yii\db\Exception
     */
    public function saveRoleMenu(array $menuIds)
    {
        Yii::$app->db->createCommand()
            ->delete('{{%role_menu}}', 'role_name=:rn', [':rn' => $this->name])
            ->execute();
        foreach ($menuIds as $id) {
            if(!empty($id)) {
                Yii::$app->db->createCommand()->insert('{{%role_menu}}', [
                    'role_name' => $this->name,
                    'menu_id' => $id,
                    'created_at' => time()
                ])->execute();
            }
        }
    }
}
