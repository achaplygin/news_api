<?php

namespace App\Service\Api\Base\DTO;

class NewsItem
{
    /** @var string[]|null */
    private ?array $category = null;
    private ?string $title = null;
    private ?string $author = null;
    private ?string $content = null;
    private ?string $url = null;
    private ?string $image = null;
    private \DateTime $date;

    public function getCategory(): ?array
    {
        return $this->category;
    }

    public function setCategory(?array $category): void
    {
        $this->category = $category;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }
}
