<?php

namespace Grdf\DefaultBundle\Tests\Enum;

class EnumObjectTest extends \Symfony\Bundle\FrameworkBundle\Tests\TestCase
{

    /**
     * @test
     * @group enum
     */
    public function testGetData()
    {
        $data = TestEnum::getData();
        $this->assertTrue(is_array($data));
        $this->assertCount(4, $data);
        $this->assertArrayHasKey('CONST_TEST1', $data);
        $this->assertArrayHasKey('CONST_TEST2', $data);
        $this->assertArrayHasKey('CONST_TEST3', $data);
        $this->assertArrayHasKey('CONST_TEST4', $data);
    }

    /**
     * @test
     * @group enum
     */
    public function testGetKeys()
    {
        $data = TestEnum::getKeys();
        $this->assertTrue(is_array($data));
        $this->assertCount(4, $data);
        $this->assertContains('CONST_TEST1', $data);
        $this->assertContains('CONST_TEST2', $data);
        $this->assertContains('CONST_TEST3', $data);
        $this->assertContains('CONST_TEST4', $data);
    }

    /**
     * @test
     * @group enum
     */
    public function testGetValues()
    {
        $data = TestEnum::getValues();
        $this->assertTrue(is_array($data));
        $this->assertCount(4, $data);
        $this->assertContains('Test1', $data);
        $this->assertContains('Test2', $data);
        $this->assertContains('Test3', $data);
        $this->assertContains('Test4', $data);
    }

    /**
     * @test
     * @group enum
     */
    public function testHasKey()
    {
        $this->assertTrue(TestEnum::hasKey('CONST_TEST1'));
        $this->assertTrue(TestEnum::hasKey('CONST_TEST2'));
        $this->assertTrue(TestEnum::hasKey('CONST_TEST3'));
        $this->assertTrue(TestEnum::hasKey('CONST_TEST4'));
        $this->assertFalse(TestEnum::hasKey('CONST_TEST5'));
    }

    /**
     * @test
     * @group enum
     */
    public function testHasValue()
    {
        $this->assertTrue(TestEnum::hasValue('Test1'));
        $this->assertTrue(TestEnum::hasValue('Test2'));
        $this->assertTrue(TestEnum::hasValue('Test3'));
        $this->assertTrue(TestEnum::hasValue('Test4'));
        $this->assertFalse(TestEnum::hasValue('Test5'));
    }

    /**
     * @test
     * @group enum
     */
    public function testGetKey()
    {
        $this->assertEquals('CONST_TEST1', TestEnum::getKey('Test1'));
        $this->assertEquals('CONST_TEST2', TestEnum::getKey('Test2'));
        $this->assertEquals('CONST_TEST3', TestEnum::getKey('Test3'));
        $this->assertEquals('CONST_TEST4', TestEnum::getKey('Test4'));
        $this->assertNull(TestEnum::getKey('Test5'));
    }

    /**
     * @test
     * @group enum
     */
    public function testGetValue()
    {
        $this->assertEquals('Test1', TestEnum::getValue('CONST_TEST1'));
        $this->assertEquals('Test2', TestEnum::getValue('CONST_TEST2'));
        $this->assertEquals('Test3', TestEnum::getValue('CONST_TEST3'));
        $this->assertEquals('Test4', TestEnum::getValue('CONST_TEST4'));
        $this->assertNull(TestEnum::getValue('CONST_TEST5'));
    }

    /**
     * @test
     * @group enum
     */
    public function testGetDataFromKeys()
    {
        $keys = array('CONST_TEST1', 'CONST_TEST3');
        $data = TestEnum::getDataFromKeys($keys);
        $this->assertTrue(is_array($data));
        $this->assertCount(2, $data);
        $this->assertArrayHasKey('CONST_TEST1', $data);
        $this->assertEquals('Test1', $data['CONST_TEST1']);
        $this->assertArrayHasKey('CONST_TEST3', $data);
        $this->assertEquals('Test3', $data['CONST_TEST3']);
    }

}
