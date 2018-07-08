<?php
namespace tests\Unit;

use phpDocumentor\Reflection\Types\Null_;
use \PHPUnit\Framework\TestCase;
use PHPUnit\Test\NullPrinter;
use src\Commands\DivCommand;


//Need to implement test
class DivCommandTest extends TestCase
{
    /**
     * @var DivCommand
     */
    private $command;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->command = new DivCommand();
    }

    /**
     * @return array
     */
    public function commandPositiveDataProvider()
    {
        return [
            [1, 2, 0.5],
            [25, 5, 5],
            [10, 2, 5],
            ['81', 9, 9],
        ];
    }

    /**
     * @return array
     */
    public function commandNegativeDataProvider()
    {
        return [
            [1, null ],
            [1, 0 ],
            [1, '' ],
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
     * Test if number of arguments is != 2
     * @expectedException \InvalidArgumentException
     */
    public function testCommandArgumentNegative()
    {
        $this->command->execute(1,3,3,32);
    }

    /**
     * Test if 2nd argument is equal to 0
     * @dataProvider commandNegativeDataProvider
     */
    public function testCommandNegative($a, $b)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->command->execute($a, $b);
    }


    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        unset($this->command);
    }
}
