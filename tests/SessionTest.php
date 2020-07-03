<?php

class SessionTest extends \PHPUnit\Framework\TestCase{

    public function testSession()
    {
        $obj = new app\services\Session;
        $testNane = 'test';
        $testKey = '111';
        $testValue = 222;

        $obj->set($testNane, $testKey , $testValue);

        $val = $obj->get($testNane, $testKey);
        $this->assertEquals(222, $val);

        $obj->delete($testNane);
        $this->assertFalse($obj->isSession($testNane));
    }
}