<?php
declare(strict_types=1);

namespace app\responder;

use JsonSerializable;

class JsonResponder implements JsonSerializable
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array|object|null
     */
    private $data;

    /**
     * @var null
     */
    private $message;

    /**
     * @param array|object|null     $data
     * @param int                   $statusCode
     * @param null                  $message
     */
    public function __construct(int $statusCode = 200, $data = null, ?string $message = null) 
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array|null|object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return ActionError|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $payload = [
            'statusCode' => $this->statusCode,
        ];

        if ($this->data !== null) {
            $payload['data'] = $this->data;
        }

        if ($this->message !== null) {
            $payload['message'] = $this->message;
        }

        return $payload;
    }
}
