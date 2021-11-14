<?php

namespace App\Enum\NewsCategory;

use App\Enum\BaseEnum;

abstract class BaseApiCategories extends BaseEnum
{
    public const CATEGORY_MAPPING = [];

    public static function mapApiToCommonCategory(string $category): string
    {
        return static::CATEGORY_MAPPING[$category];
    }

    abstract public static function mapCommonToApiCategory(string $commonCategory): string;
}

