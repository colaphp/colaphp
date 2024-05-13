<?php

declare(strict_types=1);

namespace Tests\Unit;

use Flame\Support\Carbon;
use Tests\TestCase;

class CarbonTest extends TestCase
{
    public function test_carbon()
    {
        $timestampInMilliseconds = 1706185041888;
        $timestampInSeconds = $timestampInMilliseconds / 1000;
        $date = Carbon::createFromTimestamp($timestampInSeconds)->format('Y-m-d H:i:s');
        dd($date);

        // 设定起始日期和结束日期
        $start_date = Carbon::parse('2024-12-27');
        $end_date = Carbon::parse('2025-01-04');

        // 创建一个空数组来存储日期范围内的所有日期
        $dates_within_range = [];

        // 循环遍历日期范围内的每一天并将其添加到数组中
        while ($start_date->lte($end_date)) {
            $dates_within_range[] = $start_date->copy(); // 将日期添加到数组中
            $start_date->addDay(); // 移动到下一天
        }

        // 打印输出日期范围内的所有日期
        foreach ($dates_within_range as $date) {
            echo $date->toDateString()."\n";
        }

        $now = now();
        $startTime = $now->subMinutes(10)->toDateTimeString();
        $endTime = $now->subMinutes(5)->toDateTimeString();

        dump($startTime);
        dump($endTime);

        $now = now()->subDays(4);
        dump($now->diffForHumans());

        $startDate = now()->startOfDay()->toDateTimeString();
        $endDate = now()->endOfDay()->toDateTimeString();

        dump($startDate);
        dump($endDate);

        $startDate = now()->startOfWeek()->toDateTimeString();
        $endDate = now()->endOfWeek(5)->toDateTimeString();

        dump($startDate);
        dump($endDate);

        $startDate = now()->startOfMonth()->toDateTimeString();
        $endDate = now()->startOfMonth()->addDays(14)->toDateTimeString();

        dump($startDate);
        dump($endDate);

        $weekday = now()->weekday();
        dump($weekday);

        $monthDay = now()->day;
        dump($monthDay);

        $monthDays = now()->daysInMonth;
        dump($monthDays);

        $this->assertTrue(true);
    }
}
