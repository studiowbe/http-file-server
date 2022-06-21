<?php

namespace Smartconnect\Http\FileServer\Finder\Disk;

use Smartconnect\Http\FileServer\Finder\FileInfoInterface;

class FileInfo implements FileInfoInterface
{
    private $mime;

    private $path;

    public function __construct(
        string $mime, string $path
    ) {
        $this->mime = $mime;
        $this->path = $path;
    }

    public function getMime(): string
    {
        return $this->mime;
    }

    public function getContent(): string
    {
        return file_get_contents($this->path);
    }
}
