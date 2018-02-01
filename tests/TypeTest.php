<?php

namespace Tests;

use Joshbrw\TypeEnforcement\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{

    /** @test */
    public function does_not_throw_exception_on_valid_type()
    {
        $response = Type::enforce(new \Directory, \Directory::class);

        $this->assertInstanceOf(\Directory::class, $response);
    }

    /** @test */
    public function throws_invalid_argument_exception_on_mismatched_types()
    {
        $this->expectException(\InvalidArgumentException::class);

        $invalid = [ 'array' ];

        Type::enforce($invalid, NonExistentClass::class);
    }

    /** @test */
    public function can_enforce_scalar_types()
    {
        $this->assertInternalType('string', Type::enforce('I am a string', 'string'));
        $this->assertInternalType('array', Type::enforce(['one', 'two', 'three'], 'array'));
        $this->assertInternalType('integer', Type::enforce(5, 'integer'));
    }

    /** @test */
    public function custom_exception_message_can_be_provided()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedMessage = 'Custom message');

        Type::enforce(['array'], 'string',$expectedMessage);
    }


}
