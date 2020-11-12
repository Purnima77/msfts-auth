<?php
declare(strict_types=1);


namespace Misfits\Auth\Method\HMAC;


use Misfits\Auth\Token\TokenInterface;

/**
 * Class HMACAuthentication
 *  - Hash-based Message Authentication Code
 * @package Misfits\Auth
 */
class MD5HMACAuthentication extends HMACAuthentication
{
    /**
     * @param TokenInterface[] $tokens
     * @return string
     */
    public function generateHash(array $tokens): string
    {
        $tokenValues = array_map(static function(TokenInterface $token){
            return $token->getValue();
        }, $tokens);

        $tokenValueString = implode($this->tokenValueSeparator, $tokenValues);

        return md5($tokenValueString);
    }

}