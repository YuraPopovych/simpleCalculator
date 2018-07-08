<?php
namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Commands\SubCommand;


//Need to implement test
class SubCommandTest extends TestCase
{
    /**
     * @var SubCommand
     */
    private $command;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->command = new SubCommand();
    }

    /**
     * @return array
     */
    public function commandPositiveDataProvider()
    {
        return [
            [1, 1, 0],
            [0.1, 0.1, 0],
            [-1, 2, -3],
            ['5', 10, -5],
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
    public function testCommandArgumentNegative()
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
