<?php
declare(strict_types=1);


namespace Misfits\Auth\Token;


/**
 * Interface TokenInterface
 */
interface TokenInterface
{
    /**
     * This function should return the value of the token
     * @return mixed
     */
    public function getValue();
}