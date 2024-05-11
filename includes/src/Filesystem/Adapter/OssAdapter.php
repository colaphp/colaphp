<?php

namespace Swift\Filesystem\Adapter;

use OSS\Core\OssException;
use OSS\OssClient;
use Swift\Filesystem\Exception\StorageException;
use Throwable;

/**
 * Class OssAdapter
 * @package Swift\Filesystem\Adapter
 */
class OssAdapter extends AdapterAbstract
{
    /**
     * @var OssClient|null
     */
    protected static ?OssClient $instance = null;

    /**
     * @return OssClient|null
     */
    public static function getInstance(): ?OssClient
    {
        if (is_null(self::$instance)) {
            $config = config('filesystems.disks.oss');
            static::$instance = new OssClient(
                $config['accessKeyId'],
                $config['accessKeySecret'],
                $config['endpoint']
            );
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
            $config = config('filesystems.disks.oss');
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
                $upload = self::getInstance()->uploadFile($config['bucket'], $object, $file->getPathname());
                if (!isset($upload['info']) && 200 != $upload['info']['http_code']) {
                    throw new StorageException((string)$upload);
                }
                array_push($result, $temp);
            }
        } catch (Throwable|OssException $exception) {
            throw new StorageException($exception->getMessage());
        }

        return $result;
    }

    /**
     * 上传本地文件
     * @param array $options
     * @return array
     */
    public function uploadLocalFile(array $options = []): array
    {
        if (!isset($options['file_path']) || !isset($options['extension'])) {
            throw new StorageException('上传文件路径 file_path 和扩展名 extension 是必须的');
        }
        $config = config('filesystems.disks.oss');
        $uniqueId = date('YmdHis') . uniqid();
        $object = $config['dirname'] . DIRECTORY_SEPARATOR . $uniqueId . '.' . $options['extension'];

        $result = [
            'origin_name' => $options['file_path'],
            'save_name' => $object,
            'save_path' => $object,
            'url' => $config['domain'] . DIRECTORY_SEPARATOR . $object,
            'unique_id' => $uniqueId,
            'size' => 0,
            'extension' => $options['extension'],
        ];
        $upload = self::getInstance()->uploadFile($config['bucket'], $object, $options['file_path']);
        if (!isset($upload['info']) && 200 != $upload['info']['http_code']) {
            throw new StorageException((string)$upload);
        }
        return $result;
    }

    /**
     * 上传Base64
     * @param array $options
     * @return array
     */
    public function uploadBase64(array $options): array
    {
        if (!isset($options['base64'])) {
            $this->setError(false, 'base64参数不能为空');
        }
        if (!isset($options['extension'])) {
            $this->setError(false, 'extension参数不能为空');
        }
        $base64 = explode(',', $options['base64']);
        $config = config('filesystems.disks.oss');
        $bucket = $config['bucket'];
        $object = $config['dirname'] . DIRECTORY_SEPARATOR . uniqid() . '.' . $options['extension'];
        try {
            $result = self::getInstance()->putObject($bucket, $object, base64_decode($base64[1]));
            if (!isset($result['info']) && $result['info']['http_code'] != 200) {
                $this->setError(false, (string)$result);
            }
        } catch (OssException $e) {
            $this->setError(false, $e->getMessage());
        }
        $url = $config['domain'] . DIRECTORY_SEPARATOR . $object;
        $img_len = strlen($base64['1']);
        $file_size = $img_len - ($img_len / 8) * 2;
        return ['url' => $url, 'file_name' => $object, 'file_size' => $file_size];
    }
}
