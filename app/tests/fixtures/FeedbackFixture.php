<?php
/**
 * Created by PhpStorm.
 * User: coderkim
 * Date: 18-7-21
 * Time: 上午3:37
 */

namespace app\tests\fixtures;


use app\models\Feedback;
use yii\test\ActiveFixture;

class FeedbackFixture extends ActiveFixture
{
    public $modelClass = Feedback::class;
    public $dataFile = '@app/tests/fixtures/data/feedback.php';
}