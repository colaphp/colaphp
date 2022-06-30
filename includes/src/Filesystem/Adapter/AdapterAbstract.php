<?php

namespace Swift\Filesystem\Adapter;

use Swift\Filesystem\Exception\StorageException;
use Swift\Filesystem\Traits\ErrorMsg;
use Swift\Http\UploadFile;

/**
 * Class AdapterAbstract
 * @package Swift\Filesystem\Adapter
 */
abstract class AdapterAbstract implements AdapterInterface
{
    use ErrorMsg;

    /**
     * 文件存储对象
     * @var array|UploadFile|null
     */
    protected $files;

    /**
     * 被允许的文件类型列表
     * @var array
     */
    protected array $includes;

    /**
     * 不被允许的文件类型列表
     * @var array
     */
    protected array $excludes;

    /**
     * 单个文件的最大字节数
     * @var int
     */
    protected int $singleLimit;

    /**
     * 多个文件的最大数量
     * @var int
     */
    protected int $totalLimit;

    /**
     * 文件上传的最大数量
     * @var int
     */
    protected int $nums;

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->files = request()->file();
        $this->includes = [];
        $this->excludes = [];
        $this->singleLimit = 0;
        $this->totalLimit = 0;
        $this->nums = 0;
        $this->loadConfig($config);
        $this->verify();
    }

    /**
     * 加载配置文件
     * @param array $config
     * @return void
     */
    protected function loadConfig(array $config)
    {
        $defaultConfig = config('filesystems');
        $this->includes = $config['include'] ?? $defaultConfig['include'];
        $this->excludes = $config['exclude'] ?? $defaultConfig['exclude'];
        $this->singleLimit = $config['single_limit'] ?? $defaultConfig['single_limit'];
        $this->totalLimit = $config['total_limit'] ?? $defaultConfig['total_limit'];
        $this->nums = $config['nums'] ?? $defaultConfig['nums'];
    }

    /**
     * 文件验证
     * @return void
     */
    protected function verify()
    {
        if (!$this->files) {
            throw new StorageException('未找到符合条件的文件资源');
        }
        foreach ($this->files as $file) {
            if (!$file->isValid()) {
                throw new StorageException('未选择文件或者无效的文件');
            }
        }
        $this->allowedFile();
        $this->allowedFileSize();
    }

    /**
     * 获取文件大小
     * @param UploadFile $file
     * @return int
     */
    protected function getSize(UploadFile $file): int
    {
        return $file->getSize();
    }

    /**
     * 允许上传文件
     * @return bool
     */
    protected function allowedFile(): bool
    {
        if ((!empty($this->includes) && !empty($this->excludes)) || !empty($this->includes)) {
            foreach ($this->files as $file) {
                $fileName = $file->getUploadName();
                if (!strpos($fileName, '.') || !in_array(substr($fileName, strripos($fileName, '.') + 1), $this->includes)) {
                    throw new StorageException($file->getUploadName() . '，文件扩展名不合法');
                }
            }
        } elseif (!empty($this->excludes) && empty($this->includes)) {
            foreach ($this->files as $file) {
                $fileName = $file->getUploadName();
                if (!strpos($fileName, '.') || in_array(substr($fileName, strripos($fileName, '.') + 1), $this->excludes)) {
                    throw new StorageException($file->getUploadName() . '，文件扩展名不合法');
                }
            }
        }

        return true;
    }

    /**
     * 允许上传文件大小
     * @return void
     */
    protected function allowedFileSize()
    {
        $fileCount = count($this->files);
        if ($fileCount > $this->nums) {
            throw new StorageException('文件数量过多，超出系统文件数量限制');
        }
        $totalSize = 0;
        foreach ($this->files as $k => $file) {
            $fileSize = $this->getSize($this->files[$k]);
            if ($fileSize > $this->singleLimit) {
                throw new StorageException($file->getUploadName() . '，单文件大小已超出系统限制：' . $this->singleLimit);
            }
            $totalSize += $fileSize;
        }
        if ($totalSize > $this->totalLimit) {
            throw new StorageException('总文件大小已超出系统最大限制：' . $this->totalLimit);
        }
    }
}
