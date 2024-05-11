<?php

declare(strict_types=1);

namespace App\Exceptions;

use Flame\Foundation\Exception\ExceptionHandler;
use Flame\Http\Request;
use Flame\Http\Response;
use Throwable;

/**
 * Class Handler
 */
class Handler extends ExceptionHandler
{
    /**
     * @var string[]
     */
    public $dontReport = [
        BusinessException::class,
    ];

    /**
     * @param  Throwable  $exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @param  Request  $request
     * @param  Throwable  $exception
     * @return Response
     */
    public function render(Request $request, Throwable $exception): Response
    {
        return parent::render($request, $exception);
    }
}
