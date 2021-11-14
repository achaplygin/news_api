<?php

namespace App\Enum\NewsCategory;

use App\Enum\BaseEnum;

class CommonCategories extends BaseEnum
{
    public const
        ALL           = 'all',
        TECHNOLOGY    = 'technology',
        BUSINESS      = 'business',
        SCIENCE       = 'science',
        ENTERTAINMENT = 'entertainment',
        WORLD         = 'world',
        SPORTS        = 'sports',
        POLITICS      = 'politics';
}
