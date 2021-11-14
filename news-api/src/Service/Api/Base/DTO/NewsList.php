<?php

namespace App\Service\Api\Base\DTO;

class NewsList
{
    /** @var NewsItem[] */
    private array $data = [];

    /**
     * @return NewsItem[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param NewsItem[] $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param NewsItem[] $data
     */
    public function addNews(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    public function order(): void
    {
        usort($this->data, static function (NewsItem $a, NewsItem $b) {
            return -($a->getDate() <=> $b->getDate());
        });
    }
}
