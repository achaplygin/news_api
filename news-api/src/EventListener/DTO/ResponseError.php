<?php


namespace App\EventListener\DTO;


class ResponseError implements \JsonSerializable
{
    private string $message;
    private ?string $property = null;

    public function __construct(?string $message = null, ?string $property = null)
    {
        $this->message = $message ?? 'common_general_error';
        $this->property = $property;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function jsonSerialize(): array
    {
        $result = [
            'message' => $this->message,
        ];

        if ($this->property !== null) {
            $result['property'] = $this->property;
        }

        return $result;
    }
}
