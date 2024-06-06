<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\DictOptionEntity;
use Exception;
use Flame\Database\Contracts\RepositoryInterface;
use Flame\Database\Model;
use Flame\Database\Repositories\CurdRepository;

class DictOptionRepository extends CurdRepository implements RepositoryInterface
{
    private static ?DictOptionRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): DictOptionRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new DictOptionRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByEntity(DictOptionEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneEntityById(int $id): ?DictOptionEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new DictOptionEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneEntity(array $condition): ?DictOptionEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new DictOptionEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllEntity(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new DictOptionEntity();
            $entity->setData($item);
            $result[$key] = $entity;
        }

        return $result;
    }

    /**
     * 分页查询
     *
     * @throws Exception
     */
    public function paginateEntity(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new DictOptionEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'DictOption'): Model
    {
        $model = '\\App\\Models\\'.$modelName.'Model';

        return new $model();
    }
}