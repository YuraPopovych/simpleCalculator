<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.07.2018
 * Time: 11:19
 */

namespace src\Commands;


class SqrtCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    const EXP = 0.5;

    public function execute(...$args)
    {
        if (1 != sizeof($args)) {
            throw new \InvalidArgumentException('Should contain only one parameters');
        }

        if (-1 == $args[0]) {
            throw new \InvalidArgumentException('Imagine there\'s no heaven. We have imagine number here');
        }

        return pow($args[0], self::EXP);
    }

}