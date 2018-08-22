<?php

class HelloTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        echo 'before unit test - hello';
    }

    protected function _after()
    {
        echo 'after unit test - hello';
    }

    // tests
    public function testTimeAgoUtil()
    {
        echo \app\base\TimeAgoUtil::time_elapsed_string('2018-7-20');
        $this->assertTrue(true);
    }
}