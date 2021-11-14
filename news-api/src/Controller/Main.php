<?php

namespace App\Controller;

use App\Controller\DTO\RequestNews;
use App\Service\NewsAggregator\NewsAggregator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class Main extends AbstractController
{
    private NewsAggregator $aggregator;
    private SerializerInterface $serializer;

    public function __construct(NewsAggregator $aggregator, SerializerInterface $serializer)
    {
        $this->aggregator = $aggregator;
        $this->serializer = $serializer;
    }

    public function allNews(RequestNews $formData): JsonResponse
    {
        $data = $this->aggregator->getNews($formData);
        $response = $this->serializer->serialize($data, 'json');

        return new JsonResponse($response, Response::HTTP_OK, [], true);
    }
}
