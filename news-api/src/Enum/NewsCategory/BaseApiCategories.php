<?php

namespace App\Enum\NewsCategory;

use App\Enum\BaseEnum;

abstract class BaseApiCategories extends BaseEnum
{
    public static array $categoryMapping;

    public static function mapApiToCommonCategory(string $category): string
    {
        return static::$categoryMapping[$category];
    }

    abstract public static function mapCommonToApiCategory(string $commonCategory): string;
}

