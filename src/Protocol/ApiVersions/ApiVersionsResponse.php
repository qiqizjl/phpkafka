<?php

declare(strict_types=1);

namespace Longyan\Kafka\Protocol\ApiVersions;

use Longyan\Kafka\Protocol\AbstractResponse;
use Longyan\Kafka\Protocol\ApiKeys;
use Longyan\Kafka\Protocol\ProtocolField;

class ApiVersionsResponse extends AbstractResponse
{
    /**
     * The top-level error code.
     *
     * @var int
     */
    protected $errorCode;

    /**
     * The APIs supported by the broker.
     *
     * @var \Longyan\Kafka\Protocol\ApiVersions\ApiKeys[]
     */
    protected $apiKeys;

    /**
     * The duration in milliseconds for which the request was throttled due to a quota violation, or zero if the request did not violate any quota.
     *
     * @var int
     */
    protected $throttleTimeMs;

    public function __construct()
    {
        if (!isset(self::$maps[self::class])) {
            self::$maps[self::class] = [
                new ProtocolField('errorCode', 'Int16', null, 0),
                new ProtocolField('apiKeys', \Longyan\Kafka\Protocol\ApiVersions\ApiKeys::class, 'ArrayInt32', 0),
                new ProtocolField('throttleTimeMs', 'Int32', null, 1),
            ];
            self::$taggedFieldses[self::class] = [];
        }
    }

    public function getRequestApiKey(): ?int
    {
        return ApiKeys::PROTOCOL_API_VERSIONS;
    }

    public function getFlexibleVersions(): ?int
    {
        return 3;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function setErrorCode(int $errorCode): self
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @return ApiKeys[]
     */
    public function getApiKeys(): array
    {
        return $this->apiKeys;
    }

    /**
     * @param ApiKeys[] $apiKeys
     */
    public function setApiKeys(array $apiKeys): self
    {
        $this->apiKeys = $apiKeys;

        return $this;
    }

    public function getThrottleTimeMs(): int
    {
        return $this->throttleTimeMs;
    }

    public function setThrottleTimeMs(int $throttleTimeMs): self
    {
        $this->throttleTimeMs = $throttleTimeMs;

        return $this;
    }
}
