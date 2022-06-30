<?php

namespace Swift\Auth;

use Swift\Auth\Exception\ExtractTokenException;
use Swift\Http\Request;

/**
 * Class BearerTokenExtractor
 * @package Swift\Auth
 */
class BearerTokenExtractor implements TokenExtractorInterface
{
    /**
     * @var Request
     */
    public Request $request;

    /**
     * BearerTokenExtractor constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 提取token
     * @return string
     */
    public function extractToken(): string
    {
        $authorization = $this->request->header('Authorization');
        if (!str_starts_with($authorization, 'Bearer ')) {
            throw new ExtractTokenException('Failed to extract token.');
        }
        return (string)substr($authorization, 7);
    }
}
