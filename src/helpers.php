<?php

use Joshbrw\TypeEnforcement\Type;

if (!function_exists('enforce_type')) {
    /**
     * Enforce a Type
     * @param mixed $actual
     * @param string $expectedType
     * @param string|null $exceptionMessage
     * @return mixed|null
     */
    function enforce_type($actual, string $expectedType, string $exceptionMessage = null)
    {
        return Type::enforce($actual, $expectedType, $exceptionMessage);
    }
}
