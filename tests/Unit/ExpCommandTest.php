<?php
namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Commands\ExpCommand;

class ExpCommandTest extends TestCase
{
    /**
     * @var ExpCommand
     */
    private $command;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->command = new ExpCommand();
    }

    /**
     * @return array
     */
    public function commandPositiveDataProvider()
    {
        return [
            [2, 8, 256],
            [-1, 2, 1],
            [10000, 0, 1],
            ['5', 2, 25],
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
     * Working example
     */
    public function testCommandNegative()
    {
        $this->command->execute(1);
    }



    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        unset($this->command);
    }
}
