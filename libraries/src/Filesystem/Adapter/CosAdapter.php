<?php

namespace Swift\Filesystem\Adapter;

use Qcloud\Cos\Client;
use Qcloud\Cos\Exception\CosException;
use Swift\Filesystem\Exception\StorageException;
use Throwable;

/**
 * Class CosAdapter
 * @package Swift\Filesystem\Adapter
 */
class CosAdapter extends AdapterAbstract
{
    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * 对象存储实例
     * @return Client|null
     */
    public static function getInstance(): ?Client
    {
        if (is_null(self::$instance)) {
            $config = config('filesystems.disks.cos');
            static::$instance = new Client([
                'region' => $config['region'],
                'schema' => 'https',
                'credentials' => [
                    'secretId' => $config['secretId'],
                    'secretKey' => $config['secretKey'],
                ],
            ]);
        }

        return static::$instance;
    }

    /**
     * 上传文件
     * @param array $options
     * @return array
     */
    public function uploadFile(array $options = []): array
    {
        try {
            $config = config('filesystems.disks.cos');
            $result = [];
            foreach ($this->files as $key => $file) {
                $uniqueId = hash_file('md5', $file->getPathname());
                $saveName = $uniqueId . '.' . $file->getUploadExtension();
                $object = $config['dirname'] . DIRECTORY_SEPARATOR . $saveName;
                $temp = [
                    'key' => $key,
                    'origin_name' => $file->getUploadName(),
                    'save_name' => $saveName,
                    'save_path' => $object,
                    'url' => $config['domain'] . DIRECTORY_SEPARATOR . $object,
                    'unique_id' => $uniqueId,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getUploadMineType(),
                    'extension' => $file->getUploadExtension(),
                ];
                self::getInstance()->putObject([
                    'Bucket' => $config['bucket'],
                    'Key' => $object,
                    'Body' => fopen($file->getPathname(), 'rb'),
                ]);
                array_push($result, $temp);
            }
        } catch (Throwable|CosException $exception) {
            throw new StorageException($exception->getMessage());
        }

        return $result;
    }

    /**
     * 上传本地文件
     * @param array $options
     * @return mixed
     */
    public function uploadLocalFile(array $options)
    {
        throw new StorageException('暂不支持');
    }

    /**
     * 上传Base64文件
     * @param array $options
     * @return mixed
     */
    public function uploadBase64(array $options)
    {
        throw new StorageException('暂不支持');
    }
}
