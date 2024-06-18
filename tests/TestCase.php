<?php

declare(strict_types=1);

namespace Tests;

use Exception;
use Flame\Http\HttpClient;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        require dirname(__DIR__).'/bootstrap/app.php';

        // Config::init();

        // DB::init();
    }

    /**
     * @throws Exception
     */
    protected function get($url, $params = [], $opts = []): string
    {
        return HttpClient::getUrl($url, $params, $opts);
    }

    /**
     * @throws Exception
     */
    protected function post($url, $data = [], $opts = []): string
    {
        return HttpClient::getUrl($url, $data, $opts);
    }
}
