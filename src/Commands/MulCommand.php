<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.07.2018
 * Time: 11:19
 */

namespace src\Commands;


class MulCommand implements CommandInterface
{
    /**
     * @inheritdoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        }

        return $args[0] * $args[1];
    }

}