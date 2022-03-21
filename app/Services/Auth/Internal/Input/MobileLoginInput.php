<?php

namespace App\Services\Auth\Internal\Input;

use App\Support\SimpleAccess;

/**
 * Class MobileLoginInput
 * @package App\Services\Auth\Internal\Input
 */
class MobileLoginInput
{
    use SimpleAccess;

    /**
     * @var string
     */
    private string $mobile;

    /**
     * @var string
     */
    private string $smsCode;

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getSmsCode(): string
    {
        return $this->smsCode;
    }

    /**
     * @param string $smsCode
     */
    public function setSmsCode(string $smsCode): void
    {
        $this->smsCode = $smsCode;
    }
}
