<?php

declare(strict_types=1);

namespace Tests\Feature;

use Exception;
use Tests\TestCase;

class HttpRequestTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_http_feature()
    {
        try {
            $this->get('https://www.fakebaidu.com/');

            $this->assertTrue(true);
        } catch (\Throwable $e) {
            $this->fail($e->getMessage());
        }
    }
}
