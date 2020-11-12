<?php
declare(strict_types=1);


namespace Misfits\Auth\Token;


/**
 * Class AuthenticationToken
 */
class AuthenticationToken implements TokenInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * AuthenticationToken constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

}