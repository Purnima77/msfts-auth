<?php
declare(strict_types=1);


use Misfits\Auth\Token\AuthenticationToken;
use Misfits\Auth\Token\TokenInterface;
use PHPUnit\Framework\TestCase;


/**
 * Class AuthenticationTokenTest
 * - tests Authentication Token
 */
class AuthenticationTokenTest extends TestCase
{

    /**
     * @dataProvider dataTestFailureOnUnexpectedParameterType
     * @param $invalidType
     */
    public function testFailureOnUnexpectedParameterType($invalidType): void
    {
        $this->expectException(TypeError::class);
        new AuthenticationToken($invalidType);
    }

    /**
     * Test failure for invalid data types
     * @see testFailureOnUnexpectedParameterType
     * @return array
     */
    public static function dataTestFailureOnUnexpectedParameterType(): array
    {
        return [
            'invalid_null' => [
                null
            ],
            'invalid_array' => [
                []
            ],
            'invalid_integer' => [
                1
            ],
            'invalid_boolean' => [
                false
            ]
        ];
    }

    public function testCreateInstance(): void
    {
        $token = new AuthenticationToken('');
        $this->assertInstanceOf(TokenInterface::class, $token);
    }

    public function testGetValue(): void
    {
        $token = new AuthenticationToken($value = 'token_value_something_is');
        $this->assertEquals($value, $token->getValue());
    }

}