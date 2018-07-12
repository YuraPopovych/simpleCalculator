<?php
namespace tests\Unit;

use http\Exception\InvalidArgumentException;
use PharIo\Manifest\Exception;
use \PHPUnit\Framework\TestCase;
use src\Calculator;
use src\Commands\CommandInterface;
use src\Commands\SumCommand;


class CalculatorTest extends TestCase
{
    /**
     * @var Calculator
     */
    private $calc;

    /**
     * TODO: explain difference between setUp() and tearDown()
     * setUp create object when we run test, tearDown delete object when we finish test
     * TODO: what difference between setUp() and setUpBeforeClass()
     * setUp create object when we run test setUpBeforeClass before test is run
     *
     * @see http://phpunit.readthedocs.io/en/7.1/fixtures.html#more-setup-than-teardown
     */
    public function setUp()
    {
        $this->calc = new Calculator();
    }

    /**
     * TODO: Which methods should be mocked for Command?
     * We should mock method which create dependencies(objects)
     * @see https://phpunit.readthedocs.io/en/7.1/test-doubles.html
     *
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function getCommandMock() {
        return $this->getMockBuilder(CommandInterface::class)
            ->getMock();
    }

    /**
     * TODO: Check whether intents = []
     * TODO: Check whether value = 0.0
     *
     * @see PHPUnit :: assertAttributeEquals
     */
    public function testInitialCalcState()
    {
        $this->assertAttributeEquals([],'intents',$this->calc);
        $this->assertAttributeEquals(0.0,'value',$this->calc);
    }

    /**
     * TODO: Check name exception
     *
     * @covers Calculator::addCommand()
     */
    public function testAddCommandNegative()
    {

        $command = $this->getCommandMock();
        $this->expectException('InvalidArgumentException');
        $this->calc->addCommand([1],$command);


    }

    /**
     * TODO: Check whether command is in the commands array
     *
     * @covers Calculator::addCommand()
     */
    public function testAddCommandPositive()
    {
        $command = $this->getCommandMock();
        $this->calc->addCommand('my command',$command);
        $this->assertAttributeContains($command, 'commands', $this->calc);
    }

    /**
     * TODO: Check whether intents = []
     * TODO: Check whether value = expected
     *
     * @see PHPUnit :: assertAttributeEquals
     *
     * @covers Calculator::init()
     */
    public function testInit()
    {
        $this->calc->init('bcd');
        $this->assertAttributeEquals('bcd','value',$this->calc);
        $this->assertAttributeEquals([],'intents',$this->calc);

    }

    /**
     * TODO: Check is_numeric exception
     * TODO: Check hasCommand exception
     *
     * @see PHPUnit :: dataProvider
     *
     * @covers Calculator::compute()
     */
    public function testComputeNegative()
    {
        $command = $this->getCommandMock();

        $this->expectException('InvalidArgumentException');

        $this->calc->compute($command,'123d');



    }

    /**
     * TODO: Check is_numeric exception
     * TODO: Check hasCommand exception
     *
     * @see PHPUnit :: dataProvider
     *
     * @covers Calculator::compute()
     */
    public function testHasCommandNegative()
    {
        $this->expectExceptionmessage('Command my command is not found');

        $this->calc->compute('my command',1,2);
    }

    /**
     * TODO: Check whether command and arguments have appeared in the intents array
     *
     * @see PHPUnit :: assertAttributeEquals
     *
     * @covers Calculator::compute()
     */
    public function testComputePositive()
    {
        $command = $this->getCommandMock();
        $this->calc->addCommand('Mike',$command);

        $this->calc->compute('Mike', 1,2,3);

        $this->assertAttributeContains([$command, [1, 2, 3]], 'intents', $this->calc  );
    }

    /**
     * TODO: Check that command was executed
     *
     * Mock command`s execute method and check whether it was called at least once with the correct arguments
     *
     * @see https://phpunit.readthedocs.io/en/7.1/test-doubles.html
     *
     * @covers Calculator::getResult()
     */
    public function testGetResultPositive()
    {

        $command = $this->getCommandMock();
        //create mock method of mock obj
        $command->expects($this->once())
            ->method('execute');
        // attach mocked obj
        $this->calc->addCommand('dont panic!',$command); //
        // initialize calc obj and call method which run execute method
        $this->calc->init(1)
            ->compute('dont panic!',1)
            ->getResult();
    }
    /**
     * TODO: Check that command was executed with exception
     *
     * Mock command`s execute method so that it returns exception and check whether it was thrown
     *
     * @see https://phpunit.readthedocs.io/en/7.1/test-doubles.html
     *
     * @covers Calculator::getResult()
     */
    public function testGetResultNegative()
    {}

    /**
     * TODO: Check whether the last item in the intents array was duplicated
     *
     * @covers Calculator::replay()
     */
    public function testReplay()
    {
        $command = $this->getCommandMock();
        $this->calc->addCommand('Mike',$command);

        $this->calc->compute('Mike', 1)
                    ->replay();
        var_dump($this->calc);
        $this->assertAttributeEquals([[$command,[1]], [$command,[1]]], 'intents', $this->calc );


    }

    /**
     * TODO: Check whether the last item was removed from intents array
     *
     * @covers Calculator::undo()
     */
    public function testUndo()
    {
        $command = $this->getCommandMock();
        $this->calc->addCommand('Mike',$command);

        $this->calc->compute('Mike', 1)
                    ->compute('Mike', 2)
                    ->compute('Mike', 3)
                    ->undo();

        $this->assertAttributeNotContains([$command,[3]], 'intents', $this->calc );
    }

    /**
     * TODO: what difference between tearDown() and tearDownAfterClass()
     *
     * @see http://phpunit.readthedocs.io/en/7.1/fixtures.html#more-setup-than-teardown
     */
    public function tearDown()
    {
        unset($this->calc);
    }
}
