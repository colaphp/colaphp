<?php

namespace Swift\Filesystem\Adapter;

/**
 * Class LocalAdapter
 * @package Swift\Filesystem\Adapter
 */
class LocalAdapter extends AdapterAbstract
{
    /**
     * @param array $options
     * @return array
     */
    public function uploadFile(array $options = []): array
    {
        $result = [];
        $config = config('filesystems.disks.local');
        foreach ($this->files as $key => $file) {
            $uniqueId = hash_file('md5', $file->getPathname());
            $saveFilename = $uniqueId . '.' . $file->getUploadExtension();
            $savePath = $config['root'] . DIRECTORY_SEPARATOR . $saveFilename;
            $temp = [
                'key' => $key,
                'origin_name' => $file->getUploadName(),
                'save_name' => $saveFilename,
                'save_path' => $savePath,
                'url' => $config['domain'] . $config['dirname'] . DIRECTORY_SEPARATOR . $saveFilename,
                'unique_id' => $uniqueId,
                'size' => $file->getSize(),
                'mime_type' => $file->getUploadMineType(),
                'extension' => $file->getUploadExtension(),
            ];
            $file->move($savePath);
            array_push($result, $temp);
        }

        return $result;
    }

    /**
     * @param array $options
     * @return array
     */
    public function uploadLocalFile(array $options)
    {
        return [];
    }

    /**
     * @param array $options
     * @return array
     */
    public function uploadBase64(array $options)
    {
        return [];
    }
}
