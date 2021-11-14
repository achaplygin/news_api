<?php

namespace App\Enum\NewsCategory;

class CurrentsCategories extends BaseApiCategories
{
    public const REGIONAL      = 'regional';
    public const TECHNOLOGY    = 'technology';
    public const LIFESTYLE     = 'lifestyle';
    public const BUSINESS      = 'business';
    public const GENERAL       = 'general';
    public const PROGRAMMING   = 'programming';
    public const SCIENCE       = 'science';
    public const ENTERTAINMENT = 'entertainment';
    public const WORLD         = 'world';
    public const SPORTS        = 'sports';
    public const FINANCE       = 'finance';
    public const ACADEMIA      = 'academia';
    public const POLITICS      = 'politics';
    public const HEALTH        = 'health';
    public const OPINION       = 'opinion';
    public const FOOD          = 'food';
    public const GAME          = 'game';

    public const CATEGORY_MAPPING = [
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
        foreach (self::CATEGORY_MAPPING as $category => $common) {
            if ($commonCategory === $common) {
                $result[] = $category;
            }
        }

        return implode(',', $result);
    }
}
