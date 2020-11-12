<?php
declare(strict_types=1);

namespace Misfits\Auth\Method;


use Misfits\Auth\Token\TokenInterface;

/**
 * Interface AuthenticationInterface
 * @package Arcade\Application\Authentication
 */
interface AuthenticationInterface
{
    /**
     * This function should authenticate the provided token
     * @param TokenInterface $token
     */
    public function authenticate(TokenInterface $token);
}