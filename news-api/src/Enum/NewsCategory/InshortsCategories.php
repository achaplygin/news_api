<?php

namespace App\Enum\NewsCategory;

class InshortsCategories extends BaseApiCategories
{
    public const
        ALL           = 'all',
        NATIONAL      = 'national', //Indian News only
        BUSINESS      = 'business',
        SPORTS        = 'sports',
        WORLD         = 'world',
        POLITICS      = 'politics',
        TECHNOLOGY    = 'technology',
        STARTUP       = 'startup',
        ENTERTAINMENT = 'entertainment',
        MISCELLANEOUS = 'miscellaneous',
        HATKE         = 'hatke',
        SCIENCE       = 'science',
        AUTOMOBILE    = 'automobile';

    public static array $categoryMapping = [
        self::ALL           => CommonCategories::ALL,
        self::NATIONAL      => CommonCategories::WORLD,
        self::BUSINESS      => CommonCategories::BUSINESS,
        self::SPORTS        => CommonCategories::SPORTS,
        self::WORLD         => CommonCategories::WORLD,
        self::POLITICS      => CommonCategories::POLITICS,
        self::TECHNOLOGY    => CommonCategories::TECHNOLOGY,
        self::STARTUP       => CommonCategories::BUSINESS,
        self::ENTERTAINMENT => CommonCategories::ENTERTAINMENT,
        self::MISCELLANEOUS => CommonCategories::WORLD,
        self::HATKE         => CommonCategories::WORLD,
        self::SCIENCE       => CommonCategories::SCIENCE,
        self::AUTOMOBILE    => CommonCategories::TECHNOLOGY,
    ];

    public static function mapCommonToApiCategory(string $commonCategory): string
    {
        if (self::isCorrect($commonCategory)) {
            return $commonCategory;
        }

        return array_search($commonCategory, self::$categoryMapping, true) ?: self::ALL;
    }
}
