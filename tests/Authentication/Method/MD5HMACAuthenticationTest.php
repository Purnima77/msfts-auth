<?php
declare(strict_types=1);

use Misfits\Auth\Token\AuthenticationToken;
use Misfits\Auth\Method\HMAC\MD5HMACAuthentication;
use PHPUnit\Framework\TestCase;

/**
 * Class MD5HMACAuthenticationTest
 */
class MD5HMACAuthenticationTest extends TestCase
{

    /**
     * This function tests hash generation as per implemented in md5HmacAuthentication
     * @see MD5HMACAuthentication::generateHash()
     */
    public function testGenerateHash(): void
    {
        $instance = new MD5HMACAuthentication(
            $privateToken = new AuthenticationToken('private'),
            $publicToken = new AuthenticationToken('public'),
            $additionalTokens = []
        );

        $tokens = array_merge([$privateToken, $publicToken], []);
        $values = array_map(static function(AuthenticationToken $token){
            return $token->getValue();
        }, $tokens);
        $stringToHash = implode('', $values);
        $expectedMd5Hash = md5($stringToHash);

        $this->assertEquals($expectedMd5Hash, $instance->generateHash($tokens));

    }


    /**
     * This function tests hash generation as per implemented in md5HmacAuthentication,
     * overriding implemented separator
     */
    public function testGenerateHashUsingDashSeparator(): void
    {
        $instance = new MD5HMACAuthentication(
            $privateToken = new AuthenticationToken('private'),
            $publicToken = new AuthenticationToken('public'),
            $additionalTokens = [],
            '-'
        );

        $tokens = array_merge([$privateToken, $publicToken], []);
        $values = array_map(static function(AuthenticationToken $token){
            return $token->getValue();
        }, $tokens);
        $stringToHash = implode($tokenValueSeparator = '-', $values);
        $expectedMd5Hash = md5($stringToHash);

        $this->assertEquals($expectedMd5Hash, $instance->generateHash($tokens));
    }

}