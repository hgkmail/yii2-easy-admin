<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
            ]
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return OperationLog
     * Return an op log with current request's ip, path, method and input.
     * @throws \yii\base\InvalidConfigException
     */
    public static function withDefault()
    {
        $log = new OperationLog();

        $log->ip = Yii::$app->request->getUserIP();
        $log->path = Yii::$app->request->getPathInfo();
        $log->method = Yii::$app->request->method;
        $log->created_at = time();

        if(isset($_REQUEST['_csrf'])) {
            $_csrf = $_REQUEST['_csrf'];
            unset($_REQUEST['_csrf']);
            $log->input = json_encode($_REQUEST);
            $_REQUEST['_csrf'] = $_csrf;
        }
        return $log;
    }

    public function saveToLog()
    {
        /* @var $monologComp \Mero\Monolog\MonologComponent */
        $monologComp = Yii::$app->monolog;
        $arr = [
            'user_id' => $this->user_id,
            'created_at' => Yii::$app->formatter->asDatetime($this->created_at),
            'ip' => $this->ip,
            'desc' => $this->description,
            'method' => $this->method,
            'path' => $this->path,
            'input' => $this->input,
        ];
        $monologComp->getLogger('op')->info(print_r($arr, true));
    }
}
