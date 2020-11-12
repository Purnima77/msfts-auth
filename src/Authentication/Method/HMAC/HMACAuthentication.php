<?php
declare(strict_types=1);


namespace Misfits\Auth\Method\HMAC;


use Misfits\Auth\Method\AuthenticationInterface;
use Misfits\Auth\Token\AuthenticationToken;
use Misfits\Auth\Token\TokenInterface;

/**
 * Class AbstractHMACAuthentication
 *  - Hash-based Message Authentication Code
 *
 * @link https://en.wikipedia.org/wiki/HMAC
 */

abstract class HMACAuthentication implements AuthenticationInterface
{

    /**
     * Private Key
     * @var AuthenticationToken
     */
    protected $privateKey;

    /**
     * Public Key
     * @var AuthenticationToken
     */
    protected $publicKey;

    /**
     * Optional Tokens for Encryption
     * @var array
     */
    protected $additionalTokens;

    /**
     * Token value separator
     * @var string
     */
    protected $tokenValueSeparator = '';

    /**
     * hmacAuthentication constructor.
     *
     * @param TokenInterface $privateKey
     * @param TokenInterface $publicKey
     * @param TokenInterface[] $additionalTokens
     * @param string $tokenValueSeparator
     */
    public function __construct(TokenInterface $privateKey, TokenInterface $publicKey, array $additionalTokens = [], string $tokenValueSeparator = '')
    {
        $this->privateKey = $privateKey;
        $this->publicKey = $publicKey;
        $this->additionalTokens = $additionalTokens;
        $this->tokenValueSeparator = $tokenValueSeparator;
    }

    /**
     * This function checks the provided $hash matches the value returned by generateHash
     * @see generateHash
     * @param TokenInterface $hash
     * @throws \Exception if values do not match
     */
    public function authenticate(TokenInterface $hash): void
    {
        $tokens = array_merge([$this->privateKey, $this->publicKey], $this->additionalTokens);

        if($hash->getValue() !== $this->generateHash($tokens)){
            throw new \Exception('Unauthorised request');
        }
    }

    /**
     * This function should implement the hashing algorithm to implement
     * @param TokenInterface[] $tokens
     * @return string
     */
    abstract public function generateHash(array $tokens): string;
}