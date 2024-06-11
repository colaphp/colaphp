<?php

declare(strict_types=1);

namespace App\Http\Traits;

use Flame\Http\Response;

trait ResponseTrait
{
    /**
     * 模板变量
     */
    protected array $vars = [];

    /**
     * 变量赋值
     */
    protected function assign($name, $value): void
    {
        $this->vars = array_merge($this->vars, [$name => $value]);
    }

    /**
     * 获取内容
     */
    protected function fetch($template, array $vars = [], $app = null): string
    {
        return $this->display($template, $vars, $app)->rawBody();
    }

    /**
     * 视图渲染
     */
    protected function display($template, array $vars = [], $app = null): Response
    {
        $vars = array_merge($this->vars, $vars);

        return view($template, $vars, $app);
    }

    /**
     * 返回封装后的API数据到客户端
     *
     * @param  mixed  $data  要返回的数据
     * @param  array  $header  发送的Header信息
     */
    protected function success(mixed $data, array $header = []): Response
    {
        return json([
            'code' => 0,
            'message' => 'ok',
            'data' => $data,
        ])->withHeaders($header);
    }

    /**
     * 返回异常数据到客户端
     *
     * @param  mixed  $message  错误信息
     * @param  int  $code  错误码
     * @param  array  $headers  发送的Header信息
     */
    protected function error(mixed $message, int $code = 400, array $headers = []): Response
    {
        return json([
            'code' => $code,
            'message' => $message,
            'data' => null,
        ])->withHeaders($headers);
    }
}
