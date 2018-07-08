<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.07.2018
 * Time: 11:19
 */

namespace src\Commands;


class DivCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        }

        if ($args[1] == 0) {
            throw new \InvalidArgumentException('Cannot divide on zero');
        }

        return $args[0] / $args[1];
    }

}