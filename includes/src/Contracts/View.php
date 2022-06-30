<?php

namespace Swift\Contracts;

/**
 * Interface View
 * @package Swift\Contracts
 */
interface View
{
    /**
     * @param $name
     * @param null $value
     */
    public static function assign($name, $value = null);

    /**
     * @param $template
     * @param $vars
     * @param null $app
     * @return string
     */
    public static function render($template, $vars, $app = null): string;
}
