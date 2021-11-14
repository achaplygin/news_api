<?php

namespace App\Service\NewsAggregator;

use App\Controller\DTO\RequestNews;
use App\Service\Api\Base\BaseApi;
use App\Service\Api\Base\DTO\NewsList;

class NewsAggregator
{
    /** @var BaseApi[] */
    private array $sources;

    public function __construct(array $sources)
    {
        $this->sources = $sources;
    }

    public function getNews(RequestNews $formData): NewsList
    {
        $result = new NewsList();
        foreach ($this->sources as $source) {
            $category = $source->prepareCategory($formData->getCategory());
            $response = $source->getNews($category);
            if ($response) {
                $result->addNews($response->getData());
            }
        }

        $result->order();

        return $result;
    }
}
