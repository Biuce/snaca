<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FunctionTest extends TestCase
{
    public function testIsChecked()
    {
        $this->assertTrue(isChecked('index', 'index,list,keyword'));
        $this->assertFalse(isChecked('balabala', 'index,list,keyword'));
    }

    public function testParseEntityFieldParams()
    {
        $this->assertEquals([['title', 'girl']], parseEntityFieldParams('title=girl'));
        $this->assertEquals([['title', 'girl'], ['age', 30]], parseEntityFieldParams("title=girl\nage=30"));
    }
}
