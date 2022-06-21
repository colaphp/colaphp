<?php

namespace App\Managers\LBS\Contract;

interface FactoryContract
{
    /**
     * Get a lbs driver instance by name.
     *
     * @param string|null $name
     * @return RepositoryContract
     */
    public function driver($name = null): RepositoryContract;
}
