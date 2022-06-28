<?php

namespace Swift\Filesystem\Adapter;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Swift\Filesystem\Exception\StorageException;
use Throwable;

/**
 * Class QiniuAdapter
 * @package Swift\Filesystem\Adapter
 */
class QiniuAdapter extends AdapterAbstract
{
    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * @return UploadManager|null
     */
    public static function getInstance(): ?UploadManager
    {
        if (is_null(self::$instance)) {
            static::$instance = new UploadManager();
        }

        return static::$instance;
    }

    /**
     * @return string
     */
    public static function getUploadToken(): string
    {
        $config = config('filesystems.disks.qiniu');
        $auth = new Auth($config['accessKey'], $config['secretKey']);

        return $auth->uploadToken($config['bucket']);
    }

    /**
     * 上传文件
     * @param array $options
     * @return array
     */
    public function uploadFile(array $options = []): array
    {
        try {
            $config = config('filesystems.disks.qiniu');
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
                list($ret, $err) = self::getInstance()->putFile(self::getUploadToken(), $object, $file->getPathname());
                if (!empty($err)) {
                    throw new StorageException((string)$err);
                }
                array_push($result, $temp);
            }
        } catch (Throwable $exception) {
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
