<?php

declare(strict_types=1);

namespace Tests\Feature;

use Flame\Snowflake\Exception\SnowflakeException;
use Flame\Snowflake\Snowflake;
use Flame\Snowflake\Sonyflake;
use Tests\TestCase;

class SnowflakeTest extends TestCase
{
    /**
     * @throws SnowflakeException
     */
    public function testSnowflake()
    {
        $snowFlake = new Snowflake();
        $orderNo1 = $snowFlake->id();
        dump($orderNo1);

        $sonyFlake = new Sonyflake();
        $orderNo2 = $sonyFlake->id();
        dump($orderNo2);

        $orderNo3 = bin2hex(pack('d', microtime(true)).pack('N', mt_rand()));
        dump($orderNo3);

        $map = [];
        for ($i = 0; $i < 100; $i++) {
            $id = $sonyFlake->id();
            if (isset($map[$id])) {
                $this->fail('Duplicate id: '.$id);
            }
            $map[$id] = 1;
        }

        $this->assertNotEmpty('');
    }
}
