<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%operation_log}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $created_at
 * @property string $ip
 * @property string $path
 * @property string $input
 * @property string $method
 * @property string $description
 */
class OperationLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%operation_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
            [['input'], 'string'],
            [['ip', 'method', 'description'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 1000],
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
            'created_at' => Yii::t('app', 'Created At'),
            'ip' => Yii::t('app', 'Ip'),
            'path' => Yii::t('app', 'Path'),
            'input' => Yii::t('app', 'Input'),
            'method' => Yii::t('app', 'Method'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return OperationLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OperationLogQuery(get_called_class());
    }
}
