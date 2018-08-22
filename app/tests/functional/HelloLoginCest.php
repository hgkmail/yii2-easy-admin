<?php


class HelloLoginCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
        $I->see('Sign in to start your session');
        $I->submitForm('#login-form', ['LoginForm[username]' => 'qqq', 'LoginForm[password]' => '111']);
        $I->see('qqq');
        $I->see('Online');
    }
}
