<?php

declare(strict_types=1);

namespace App\Support;

use ArrayObject as BaseArrayObject;
use Cola\Support\Str;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use JsonSerializable;

class ArrayObject extends BaseArrayObject implements Arrayable, JsonSerializable
{
    /**
     * Get a collection containing the underlying array.
     *
     * @return Collection
     */
    public function collect(): Collection
    {
        return collect($this->getArrayCopy());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Get the array that should be JSON serialized.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->getArrayCopy();
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
