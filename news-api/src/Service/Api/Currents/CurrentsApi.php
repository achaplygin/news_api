<?php

namespace App\Service\Api\Currents;

use App\Enum\NewsCategory\InshortsCategories;
use App\Form\Currents\CurrentsNewsType;
use App\Service\Api\Base\BaseApi;
use App\Service\Api\Base\DTO\NewsList;

class CurrentsApi extends BaseApi
{
    protected const FORM_CLASS = CurrentsNewsType::class;
    protected const ENUM_CLASS = InshortsCategories::class;

    public function getNews(string $category): ?NewsList
    {
        return $this->get('/search', ['category' => $category, 'apiKey' => $this->auth]);
    }
}
