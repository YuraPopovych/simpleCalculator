<?php
namespace tests\Unit;

use \PHPUnit\Framework\TestCase;
use src\Commands\SqrtCommand;

class SqrtCommandTest extends TestCase
{
    /**
     * @var SqrtCommand
     */
    private $command;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->command = new SqrtCommand();
    }

    /**
     * @return array
     */
    public function commandPositiveDataProvider()
    {
        return [
            [4, 2],
            [16, 4],
            [25, 5],
            ['64', 8],
        ];
    }

    /**
     * @dataProvider commandPositiveDataProvider
     */
    public function testCommandPositive($a, $expected)
    {
        $result = $this->command->execute($a);

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     * Working example
     */
    public function testCommandNegative()
    {
        $this->command->execute(1,2);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Imagine there's no heaven. We have imagine number here
     *
     */
    public function testCommandNegativeImagineNumber()
    {
        $this->command->execute(-1);
    }



    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        unset($this->command);
    }
}
