<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-1
 * Time: 下午12:30
 */

namespace app\services;


use app\base\NotLoginException;
use app\models\Option;
use yii\base\Component;

class OptionService extends Component
{
    public function saveOption($key, $value, $type=Option::TYPE_GLOBAL, $userId=null)
    {
        $option = $this->getOption($key, $type, $userId);
        if ($option == null) {
            $option = new Option();
        }
        $option->type = $type;
        $option->key = $key;
        $option->value = $value;
        $option->user_id = $userId;
        $option->save();
    }

    public function getOption($key, $type=Option::TYPE_GLOBAL, $userId=null)
    {
        $query = Option::find()->where(['type' => $type, 'key' => $key]);
        if ($userId != null) {
            $query->andWhere(['user_id' => $userId]);
        }
        return $query->one();
    }

    /**
     * @param $pageRoute
     * @param $columnsVisible
     * @throws NotLoginException
     */
    public function saveGridCols($pageRoute, array $columnsVisible)
    {
        if (\Yii::$app->user->isGuest) {
            throw new NotLoginException();
        }
        $this->saveOption($pageRoute, implode(':', $columnsVisible),
            Option::TYPE_GRID_COLS, \Yii::$app->user->getId());
    }

    /**
     * @param $pageRoute
     * @return array
     * @throws NotLoginException
     */
    public function getGridCols($pageRoute)
    {
        if (\Yii::$app->user->isGuest) {
            throw new NotLoginException();
        }
        $cols = null;
        $option = $this->getOption($pageRoute, Option::TYPE_GRID_COLS, \Yii::$app->user->getId());
        if ($option != null) {
            $cols = explode(':', $option->value);
        }

        return $cols;
    }
}