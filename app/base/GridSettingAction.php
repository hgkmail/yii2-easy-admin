<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-6-1
 * Time: 下午7:06
 */

namespace app\base;


use Yii;
use yii\base\Action;

/**
 * Class GridSettingAction
 * @package app\base
 */
class GridSettingAction extends Action
{
    public function run()
    {
        $optionService = Yii::$app->get('optionService');

        $value = [];
        $pageRoute = \Yii::$app->request->post('pageRoute');
        $cols = \Yii::$app->request->post('cols');
        if(!empty($cols)) {
            foreach ($cols as $k => $v) {
                $value[] = $k;
            }
        }
        $optionService->saveGridCols($pageRoute, $value);
        // pageRoute not start with '/'
        if (substr($pageRoute, 0 , 1) != '/') {
            $pageRoute = '/'.$pageRoute;
        }
        return $this->controller->redirect($pageRoute);
    }
}