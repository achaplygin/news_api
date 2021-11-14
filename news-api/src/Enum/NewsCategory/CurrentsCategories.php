<?php

namespace App\Enum\NewsCategory;

class CurrentsCategories extends BaseApiCategories
{
    public const
        REGIONAL      = 'regional',
        TECHNOLOGY    = 'technology',
        LIFESTYLE     = 'lifestyle',
        BUSINESS      = 'business',
        GENERAL       = 'general',
        PROGRAMMING   = 'programming',
        SCIENCE       = 'science',
        ENTERTAINMENT = 'entertainment',
        WORLD         = 'world',
        SPORTS        = 'sports',
        FINANCE       = 'finance',
        ACADEMIA      = 'academia',
        POLITICS      = 'politics',
        HEALTH        = 'health',
        OPINION       = 'opinion',
        FOOD          = 'food',
        GAME          = 'game';

    public static array $categoryMapping = [
        self::REGIONAL      => CommonCategories::WORLD,
        self::TECHNOLOGY    => CommonCategories::TECHNOLOGY,
        self::LIFESTYLE     => CommonCategories::ENTERTAINMENT,
        self::BUSINESS      => CommonCategories::BUSINESS,
        self::GENERAL       => CommonCategories::WORLD,
        self::PROGRAMMING   => CommonCategories::TECHNOLOGY,
        self::SCIENCE       => CommonCategories::SCIENCE,
        self::ENTERTAINMENT => CommonCategories::ENTERTAINMENT,
        self::WORLD         => CommonCategories::WORLD,
        self::SPORTS        => CommonCategories::SPORTS,
        self::FINANCE       => CommonCategories::BUSINESS,
        self::ACADEMIA      => CommonCategories::SCIENCE,
        self::POLITICS      => CommonCategories::POLITICS,
        self::HEALTH        => CommonCategories::SCIENCE,
        self::OPINION       => CommonCategories::ENTERTAINMENT,
        self::FOOD          => CommonCategories::ENTERTAINMENT,
        self::GAME          => CommonCategories::TECHNOLOGY,
    ];

    public static function grabAllCategory(): string
    {
        return implode(',', self::getAsArray());
    }

    public static function mapCommonToApiCategory(string $commonCategory): string
    {
        if ($commonCategory === CommonCategories::ALL) {
            return self::grabAllCategory();
        }

        $result = [];
        foreach (self::$categoryMapping as $category => $common) {
            if ($commonCategory === $common) {
                $result[] = $category;
            }
        }

        return implode(',', $result);
    }
}
