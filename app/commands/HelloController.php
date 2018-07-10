<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\base\TimeAgoUtil;
use app\base\Walker;
use app\commands\misc\MyWalker;
use app\commands\misc\TreeNode;
use app\models\Menu;
use app\models\NavMenu;
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

    public function actionMenu()
    {
        /* @var $mainMenuService \app\services\MainMenuService */
        $mainMenuService = \Yii::$app->get('mainMenuService');
        $top = Menu::find()->where(['id' => 2])->one();

        $child1 = $mainMenuService->getChildren([$top]);
        foreach ($child1 as $c1) {
            echo 'c1:'.$c1->label."\n";
        }

        $child2 = $mainMenuService->getGrandchildren([$top]);
        foreach ($child2 as $c2) {
            echo 'c2:'.$c2->label."\n";
        }


    }

    public function actionTimeAgo()
    {
        echo TimeAgoUtil::time_elapsed_string('@1529488054')."\n";
    }

    public function actionPathInfo()
    {
        $name = "/home/coderkim/Desktop/study-php/yii2-easy-admin/app/hello.txt";
        echo "base: ".pathinfo($name, PATHINFO_BASENAME)."\n";   // base: hello.txt
        echo "dir: ".pathinfo($name, PATHINFO_DIRNAME)."\n";     // dir: /home/coderkim/Desktop/study-php/yii2-easy-admin/app
        echo "ext: ".pathinfo($name, PATHINFO_EXTENSION)."\n";   // ext: txt
        echo "file: ".pathinfo($name, PATHINFO_FILENAME)."\n";   // file: hello
        echo "relative: ".substr($name, strpos($name, "/app/"))."\n";
    }

    public function actionMime()
    {
        echo mime_content_type(
            '/home/coderkim/Desktop/study-php/yii2-easy-admin/app/web/upload/post/php_5b3a6ecccc13d.jpg')."\n";
        echo mime_content_type('/home/coderkim/Desktop/nginx-1.14.0.tar.gz')."\n";
    }

    public function actionImageSize()
    {
        $fn = '/home/coderkim/Desktop/study-php/yii2-easy-admin/app/web/upload/post/php_5b3a6ecccc13d.jpg';
        $info = [];
        $result = getimagesize($fn, $info);
        var_dump($result);
        var_dump($info);
    }

    // json type(db) => array(yii2)
    public function actionJsonType()
    {
        $menu = new NavMenu();
        $menu->name="aaa";
        $menu->location = "bbb";
        $menu->status = NavMenu::STATUS_ENABLED;
        $menu->created_at = $menu->updated_at = time();
        $menu->item_tree = [['id' => 100, 'children' => []], ['id' => 10], ['id' => 50]];
        $menu->save();
    }
}
