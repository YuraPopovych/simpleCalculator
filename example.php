<?php
require_once './vendor/autoload.php';

use src\Calculator;
use src\Commands\SubCommand;
use src\Commands\SumCommand;
use src\Commands\MulCommand;
use src\Commands\DivCommand;
use src\Commands\ExpCommand;
use src\Commands\SqrtCommand;


$calc = new Calculator();
$calc->addCommand('+', new SumCommand());
$calc->addCommand('-', new SubCommand());
$calc->addCommand('*', new MulCommand());
$calc->addCommand('/', new DivCommand());
$calc->addCommand('^', new ExpCommand());
$calc->addCommand('_^', new SqrtCommand());

// You can use any operation for computing
// will output 2
echo $calc->init(1)
    ->compute('+', 1)
    ->getResult();

echo PHP_EOL;

// Multiply operations
// will output 10
echo $calc->init(15)
    ->compute('+', 5)
    ->compute('-', 10)
    ->getResult();

echo PHP_EOL;

// Calculator also support REDO operation
// will output 4
echo $calc->init(1)
    ->compute('+', 1)
    ->replay()
    ->replay()
    ->getResult();

echo PHP_EOL;

// Calculator also support UNDO operation
// will output 1
echo $calc->init(1)
    ->compute('+', 5)
    ->compute('+', 5)
    ->undo()
    ->undo()
    ->getResult();

echo PHP_EOL;

// Multiplication command
// Should output 42
echo  $calc->init(3)
       ->compute('*', 14)
       ->getResult();

echo PHP_EOL;


// Division command
// Should output 42
echo  $calc->init(168)
       ->compute('/', 4)
       ->getResult();

echo PHP_EOL;

// Exponential command
// Should output 64
echo  $calc->init(8)
       ->compute('^', 2)
       ->getResult();

echo PHP_EOL;

// Sqrt command
// Should output 4
echo  $calc->init(16)
       ->compute('_^')
       ->getResult();

echo PHP_EOL;
