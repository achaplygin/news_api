<?php

namespace App\Enum;

abstract class BaseEnum
{
    public static function getAsArray(): array
    {
        $result = [];
        $ref = new \ReflectionClass(static::class);
        foreach ($ref->getReflectionConstants() as $classConstant) {
            if (is_string($classConstant->getValue())) {
                $result[$classConstant->getName()] = $classConstant->getValue();
            }
        }

        return $result;
    }

    public static function isCorrect(string $value): bool
    {
        return in_array($value, static::getAsArray(), true);
    }
}
