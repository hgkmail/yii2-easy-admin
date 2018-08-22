<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%stat}}".
 *
 * @property int $id
 * @property string $item
 * @property string $result
 * @property int $updated_at
 */
class Stat extends ActiveRecord
{
    const CHECK_INTERVAL=3600;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stat}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['result'], 'string'],
            [['updated_at'], 'integer'],
            [['item'], 'string', 'max' => 255],
            [['item'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item' => Yii::t('app', 'Item'),
            'result' => Yii::t('app', 'Result'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatQuery(get_called_class());
    }

    /**
     * update stat per hour
     */
    public static function checkUpdate()
    {
        $allStat = self::find()->all();
        foreach ($allStat as $stat) {
            if(time() - $stat->updated_at < self::CHECK_INTERVAL) {
                continue;
            }
            switch ($stat->item) {
                case 'total-user':
                    $stat->result = strval(User::find()->count());
                    $stat->save();
                    break;
                case 'total-role':
                    $stat->result = strval(Role::find()->count());
                    $stat->save();
                    break;
                case 'total-menu':
                    $stat->result = strval(Menu::find()->count());
                    $stat->save();
                    break;
                case 'total-feedback':
                    $stat->result = strval(Feedback::find()->count());
                    $stat->save();
                    break;
            }
        }
    }
}
