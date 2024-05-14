<?php

declare(strict_types=1);

namespace App\Entities;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'MigrationEntity')]
class MigrationEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'version', description: '', type: 'integer')]
    private int $version;

    #[OA\Property(property: 'migration_name', description: '', type: 'string')]
    private string $migration_name;

    #[OA\Property(property: 'start_time', description: '', type: 'string')]
    private string $start_time;

    #[OA\Property(property: 'end_time', description: '', type: 'string')]
    private string $end_time;

    #[OA\Property(property: 'breakpoint', description: '', type: 'integer')]
    private int $breakpoint;

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    public function getMigrationName(): string
    {
        return $this->migration_name;
    }

    public function setMigrationName(string $migration_name): void
    {
        $this->migration_name = $migration_name;
    }

    public function getStartTime(): string
    {
        return $this->start_time;
    }

    public function setStartTime(string $start_time): void
    {
        $this->start_time = $start_time;
    }

    public function getEndTime(): string
    {
        return $this->end_time;
    }

    public function setEndTime(string $end_time): void
    {
        $this->end_time = $end_time;
    }

    public function getBreakpoint(): int
    {
        return $this->breakpoint;
    }

    public function setBreakpoint(int $breakpoint): void
    {
        $this->breakpoint = $breakpoint;
    }
}
