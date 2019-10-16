<?php

namespace Symfony\Component\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurlTrace
{
    use HttpClientTrait;

    private $method;
    private $url;
    private $options;

    public function __construct(array $trace)
    {
        $this->method = $trace['method'];
        $this->url= $trace['url'];
        [, $this->options] = self::prepareRequest($trace['method'], $trace['url'], $trace['options'], HttpClientInterface::OPTIONS_DEFAULTS);
    }

    public function __toString(): string
    {
        $curl = sprintf("curl -v -X %s '%s'", $this->method, $this->url);

        if ($this->options['headers']) {
            foreach ($this->options['headers'] as $headerValue) {
                $curl .= sprintf(" -H '%s'", $headerValue);
            }
        }

        if ($this->options['body']) {
            $curl .= sprintf(" --data-binary '%s'", $this->options['body']);
        }

        return $curl;
    }
}
