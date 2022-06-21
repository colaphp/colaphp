<?php

namespace App\Support\Contracts;

/**
 * Class ServiceInterface
 * @package App\Support\Contracts
 */
interface ServiceInterface
{
    /**
     * 查询分页
     * @param int $page
     * @param int $limit
     * @return array|null
     */
    public function findAll(int $page, int $limit): array|null;

    /**
     * 创建、更新
     * @param InputInterface $input
     * @param int $id
     * @return bool
     */
    public function save(InputInterface $input, int $id = 0): bool;

    /**
     * 根据ID获取
     * @param int $id
     * @return array|null
     */
    public function findOne(int $id): array|null;

    /**
     * 根据ID删除
     * @param array $ids
     * @return int
     */
    public function destroy(array $ids): int;
}