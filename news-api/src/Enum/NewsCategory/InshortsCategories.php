<?php

namespace App\Enum\NewsCategory;

class InshortsCategories extends BaseApiCategories
{
    public const ALL           = 'all';
    public const NATIONAL      = 'national'; //Indian News only
    public const BUSINESS      = 'business';
    public const SPORTS        = 'sports';
    public const WORLD         = 'world';
    public const POLITICS      = 'politics';
    public const TECHNOLOGY    = 'technology';
    public const STARTUP       = 'startup';
    public const ENTERTAINMENT = 'entertainment';
    public const MISCELLANEOUS = 'miscellaneous';
    public const HATKE         = 'hatke';
    public const SCIENCE       = 'science';
    public const AUTOMOBILE    = 'automobile';

    public const CATEGORY_MAPPING = [
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

        return array_search($commonCategory, self::CATEGORY_MAPPING, true) ?: self::ALL;
    }
}
