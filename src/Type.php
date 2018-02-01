<?php

namespace Joshbrw\TypeEnforcement;

class Type
{

    /**
     * Enforce a Type
     * @param $actual
     * @param string $expectedType
     * @param string|null $exceptionMessage
     * @return mixed|null
     * @throws \InvalidArgumentException
     */
    public static function enforce($actual, string $expectedType, string $exceptionMessage = null)
    {
        if (!self::typesMatch($actual, $expectedType)) {
            $renderedActualType = (new TypeRenderer)->render($actual);

            throw new \InvalidArgumentException(
                $exceptionMessage ?? "Expected [{$expectedType}], [{$renderedActualType}] provided."
            );
        }

        return $actual;
    }

    /**
     * Ensure that the types match
     * @param $actual
     * @param $expectedType
     * @return bool
     */
    private static function typesMatch($actual, $expectedType): bool
    {
        $actualType = \gettype($actual);

        if ($actualType === 'object') {
            return $actual instanceof $expectedType;
        }

        return $actualType === $expectedType;
    }

}
