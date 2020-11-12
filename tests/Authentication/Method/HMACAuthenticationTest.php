<?php

declare(strict_types=1);


use Misfits\Auth\Method\HMAC\HMACAuthentication;
use Misfits\Auth\Token\AuthenticationToken;
use PHPUnit\Framework\TestCase;


/**
 * Class TestHmacAuthentication
 *  - for stub creation to test abstract methods
 */
class TestHMACAuthentication extends HMACAuthentication
{
    /**
     * Override abstract function
     * @param array $tokens
     * @return string
     */
    public function generateHash(array $tokens): string
    {
        return '#';
    }
}


/**
 * Class hmacAuthenticationTest
 * Test abstract class methods
 * @see HMACAuthentication
 */
class HMACAuthenticationTest extends TestCase
{
    /**
     * @var TestHMACAuthentication
     */
    private $stub;

    public function setUp(): void
    {
        $this->stub = new TestHMACAuthentication(
            $privateToken = new AuthenticationToken(''),
            $publicToken = new AuthenticationToken('')
        );
    }

    /**
     * This function tests exception is thrown when the hash value passed does not match the generateHash result
     * @throws Exception
     *@see TestHMACAuthentication::generateHash() for expected return value
     */
    public function testAuthenticateMethodThrowsException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Unauthorised request');

        $this->stub->authenticate(new AuthenticationToken('abc'));
    }

    /**
     * This function tests no error when correct validation
     */
    public function testAuthenticateMethodValidatesCorrectly(): void
    {
        try {
            $this->assertNull($this->stub->authenticate(new AuthenticationToken('#')));
        }
        catch(\Exception $e){
            $this->fail($e->getMessage());
        }
    }

}
