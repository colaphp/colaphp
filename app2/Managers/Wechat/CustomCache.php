<?php

declare(strict_types=1);

namespace App\Managers\Wechat;

use Flame\Support\Facade\Cache;
use Psr\SimpleCache\CacheInterface;

class CustomCache implements CacheInterface
{
    public function get(string $key, mixed $default = null): mixed
    {
        return Cache::get($key, $default);
    }

    public function set(string $key, mixed $value, \DateInterval|int|null $ttl = null): bool
    {
        return Cache::set($key, $value, $ttl);
    }

    public function delete(string $key): bool
    {
        return Cache::forget($key);
    }

    public function clear(): bool
    {
        return Cache::flush();
    }

    public function getMultiple(iterable $keys, mixed $default = null): array
    {
        $result = [];

        foreach ($keys as $key) {
            $result[$key] = $this->get($key, $default);
        }

        return $result;
    }

    public function setMultiple(iterable $values, \DateInterval|int|null $ttl = null): bool
    {
        foreach ($values as $key => $val) {
            $result = $this->set($key, $val, $ttl);

            if ($result === false) {
                return false;
            }
        }

        return true;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        foreach ($keys as $key) {
            $result = $this->delete($key);

            if ($result === false) {
                return false;
            }
        }

        return true;
    }

    public function has(string $key): bool
    {
        return Cache::has($key);
    }
}
