<?php

declare(strict_types=1);

namespace App\Exception;

use Cola\Foundation\Exception\ExceptionHandler;
use Cola\Http\Request;
use Cola\Http\Response;
use Throwable;

/**
 * Class Handler
 * @package App\Exception
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
     * @param Throwable $exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     */
    public function render(Request $request, Throwable $exception): Response
    {
        return parent::render($request, $exception);
    }
}
