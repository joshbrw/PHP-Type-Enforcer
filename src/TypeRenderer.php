<?php

namespace Joshbrw\TypeEnforcement;

class TypeRenderer
{

    /**
     * Render an entity's Type
     * @param $entity
     * @return string
     */
    public function render($entity): string
    {
        if (\is_object($entity)) {
            return get_class($entity);
        }

        if (\is_string($entity)) {
            return "string '{$entity}'";
        }

        if (\is_int($entity)) {
            return "integer '{$entity}'";
        }

        if (\is_bool($entity)) {
            $boolString = $entity ? 'true' : 'false';

            return "bool '{$boolString}'";
        }

        if (\is_array($entity)) {
            $arrayString = json_encode($entity);

            return "array '{$arrayString}'";
        }

        if ($jsonRepresentation = $this->getDecodedJson($entity)) {
            return $jsonRepresentation;
        }

        return (string) $entity;
    }

    /**
     * Decode an entity to JSON
     * @param $entity
     * @return string|null
     */
    protected function decodeToJson($entity)
    {
        $decoded = json_decode($entity);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $decoded;
        }

        return null;
    }

}
