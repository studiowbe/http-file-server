<?php

namespace Smartconnect\Http\FileServer\Finder\Disk;

use League\MimeTypeDetection\FinfoMimeTypeDetector;
use League\MimeTypeDetection\MimeTypeDetector;
use Smartconnect\Http\FileServer\Finder\FileInfoInterface;
use Smartconnect\Http\FileServer\Finder\FinderInterface;

class Finder implements FinderInterface
{
    private $basePath;

    private $mimeTypeDetector;

    public function __construct(string $basePath, ?MimeTypeDetector $mimeTypeDetector = null)
    {
        $this->basePath = realpath($basePath);
        $this->mimeTypeDetector = $mimeTypeDetector ?? new FinfoMimeTypeDetector();
    }

    public function find(string $identifier): ?FileInfoInterface
    {
        $file = $this->basePath.'/'.ltrim($identifier, '/');
        if (! file_exists($file)) {
            return null;
        }

        return new FileInfo(
            $this->mimeTypeDetector->detectMimeTypeFromPath($file),
            $file
        );
    }
}
