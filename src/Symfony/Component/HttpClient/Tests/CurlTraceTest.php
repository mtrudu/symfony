<?php

namespace Symfony\Component\HttpClient\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\CurlTrace;

class CurlTraceTest extends TestCase
{
    public function test_basic_http_request()
    {
        $trace = [
            'method' => 'GET',
			'url' => 'https://api.github.com/repos/symfony/symfony-docs',
			'options' => [],
        ];

        $expectedCurl = "curl -v -X GET 'https://api.github.com/repos/symfony/symfony-docs' -H 'Accept: */*'";

        $curlTrace = new CurlTrace($trace);

        self::assertEquals($expectedCurl, (string) $curlTrace);
    }
}

