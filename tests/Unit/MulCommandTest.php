<?php
namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Commands\MulCommand;


//Need to implement test
class MulCommandTest extends TestCase
{
    /**
     * @var MulCommand
     */
    private $command;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->command = new MulCommand();
    }

    /**
     * @return array
     */
    public function commandPositiveDataProvider()
    {
        return [
            [1, 42, 42],
            [1, -42, -42],
            [3, 14, 42],
            ['5', 5, 25],
        ];
    }

    /**
     * @dataProvider commandPositiveDataProvider
     */
    public function testCommandPositive($a, $b, $expected)
    {
        $result = $this->command->execute($a, $b);

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCommandNegative()
    {
        $this->command->execute(1,3,3,32);
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        unset($this->command);
    }
}
