<?php

declare(strict_types=1);

namespace App\Support;

use Cola\Support\Str;

/**
 * Trait SimpleAccess
 */
trait SimpleAccess
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $attributes = [];
        foreach ($this as $key => $value) {
            $attributes[$key] = $value;
        }

        return $attributes;
    }

    /**
     * @return array
     */
    public function valid(): array
    {
        return collect($this->toArray())->filter(function ($item) {
            return $item !== null;
        })->toArray();
    }

    /**
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = JSON_UNESCAPED_UNICODE): string
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @param $name
     * @param $arguments
     * @return bool|mixed
     */
    public function __call($name, $arguments)
    {
        $action = Str::substr($name, 0, 3);
        $property = Str::snake(Str::substr($name, 3));

        if ($action === 'get') {
            if (property_exists($this, $property)) {
                return $this->{$property};
            }
        }

        if ($action === 'set') {
            if (property_exists($this, $property)) {
                $this->{$property} = $arguments[0];

                return true;
            }
        }

        $trace = debug_backtrace();
        trigger_error('Undefined property  '.$name.' in '.$trace[0]['file'].' on line '.$trace[0]['line'], E_USER_NOTICE);

        return false;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
