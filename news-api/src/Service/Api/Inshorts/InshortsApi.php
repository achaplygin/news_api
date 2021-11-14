<?php

namespace App\Service\Api\Inshorts;

use App\Enum\NewsCategory\InshortsCategories;
use App\Form\Inshorts\InshortsNewsType;
use App\Service\Api\Base\BaseApi;
use App\Service\Api\Base\DTO\NewsList;

class InshortsApi extends BaseApi
{
    protected const FORM_CLASS = InshortsNewsType::class;
    protected const ENUM_CLASS = InshortsCategories::class;

    public function getNews(string $category): ?NewsList
    {
        return $this->get('/news', ['category' => $category]);
    }

    protected function grabResponse(array $data): ?NewsList
    {
        $category = $data['category'] ?? null;
        if ($category) {
            foreach ($data['data'] as &$item) {
                $item['category'][] = $category;
            }
        }
        unset($item);

        return parent::grabResponse($data);
    }
}
