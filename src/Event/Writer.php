<?php

namespace App\Event;

class Writer extends \App\Storage\Writer
{
    private const STORAGE_PATH = __DIR__ . '/../../cli/';

    public function create(string $key, string $value) : void
    {
        $fileName = $this->createFileName($key);

        if (file_exists($fileName) === false) {
            throw new \RuntimeException('File with key is not exists: ' . $key);
        }

        file_put_contents($fileName, $value, FILE_APPEND);
    }

    private function createFileName(string $key) : string
    {
        return self::STORAGE_PATH . $key;
    }
}