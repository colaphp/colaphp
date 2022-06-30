<?php

namespace Swift\Filesystem\Adapter;

/**
 * Class AdapterInterface
 * @package Swift\Filesystem\Adapter
 */
interface AdapterInterface
{
    /**
     * 上传文件
     * @param array $options
     * @return mixed
     */
    public function uploadFile(array $options);

    /**
     * 上传本地文件
     * @param array $options
     * @return mixed
     */
    public function uploadLocalFile(array $options);

    /**
     * Base64上传文件
     * @param array $options
     * @return mixed
     */
    public function uploadBase64(array $options);
}
