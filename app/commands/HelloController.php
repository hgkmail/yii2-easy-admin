<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\base\Walker;
use app\commands\misc\MyWalker;
use app\commands\misc\TreeNode;
use app\models\Role;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\ArrayHelper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionRegister($username, $email, $password)
    {
        // aaa 111
        // qqq 111
        \Yii::$app->get('userService')->register($username, $email, $password);
        return ExitCode::OK;
    }

    public function actionClassname()
    {
        echo HelloController::className()."\n";
        echo HelloController::class."\n";
    }

    public function actionArray()
    {
        $roles = Role::find()->all();
//        $names = [];
//        array_walk($roles, function ($val, $key) use(&$names) {
//            $names[$val->name] = $val->name;
//        });
        $temp = array_column($roles, 'name');
        $names = array_combine($temp, $temp);
        var_dump($names);
    }

    public function actionAuth()
    {
        $auth = \Yii::$app->authManager;
        $assigns = $auth->getRolesByUser(2);
        var_dump($assigns);
    }

    public function actionTree()
    {
        $tree = [
            new TreeNode('4', '2', 'aa'),
            new TreeNode('5', '3', 'bb'),
            new TreeNode('2', '1', 'a'),
            new TreeNode('1', '0', 'root'),
            new TreeNode('3', '1', 'b'),
            new TreeNode('10', '0', 'root2'),
            new TreeNode('11', '0', 'root3'),
            new TreeNode('12', '10', 'xxx'),
            new TreeNode('13', '11', 'yyy'),
        ];
        $walker = new MyWalker();
        echo $walker->paged_walk($tree, 0, 2, 2);
    }

    public function actionPush()
    {
        $arr = [];
        $arr[1]='zzz';    // this is push! php only have assoc array, even an ordinary array.
        $arr[0]='aaa';
        var_dump($arr);
        echo \Yii::getAlias('@app')."\n";
    }

    public function actionRand()
    {
        echo uniqid('file_')."\n";
        echo \Yii::$app->getSecurity()->generateRandomString(6)."\n";
    }

    public function actionString()
    {
        $world = "tom";
        echo "${world}hello\n";
    }
}
